<?php

namespace App\Models;

use App\Filament\Interfaces\FilamentLabelInterface;
use Illuminate\Support\Facades\Storage;

/**
 * Hero photo + photo gallery of a public service page (e.g. /photovoltaicSystems).
 *
 * @property string $page key from PageGallery::PAGES
 * @property null|string $hero_image path on the "public" disk
 * @property null|array<int, string> $images paths on the "public" disk
 */
class PageGallery extends GeneralModel implements FilamentLabelInterface
{
    /** Pages that have an editable gallery: key => name shown in admin. */
    public const PAGES = [
        'fotovoltika' => 'Fotovoltika',
        'kamery' => 'Kamerové systémy',
        'alarmy' => 'Alarmové systémy',
        'revizie' => 'Revízie',
        'rekuperacie' => 'Rekuperácie',
    ];

    protected $table = 'page_galleries';
    protected $fillable = [
        'page',
        'hero_image',
        'images',
    ];
    protected $casts = [
        'page' => 'string',
        'hero_image' => 'string',
        'images' => 'array',
    ];
    protected $appends = [
        'filament_label',
    ];

    protected static function booted(): void
    {
        // keep storage clean: remove photos that were replaced/removed or belonged to a deleted gallery
        static::updated(static function (PageGallery $gallery) {
            /** @var array<int, string> $old */
            $old = array_filter([...($gallery->getOriginal('images') ?? []), $gallery->getOriginal('hero_image')]);
            $new = array_filter([...($gallery->images ?? []), $gallery->hero_image]);
            Storage::disk('public')->delete(array_diff($old, $new));
        });
        static::deleted(static function (PageGallery $gallery) {
            Storage::disk('public')->delete(array_filter([...($gallery->images ?? []), $gallery->hero_image]));
        });
    }

    public static function forPage(string $page): ?self
    {
        return self::query()->where('page', $page)->first();
    }

    public function getFilamentLabelAttribute(): string
    {
        return self::PAGES[$this->page] ?? $this->page;
    }

    public function heroUrl(): ?string
    {
        $disk = Storage::disk('public');

        return $this->hero_image && $disk->exists($this->hero_image) ? $disk->url($this->hero_image) : null;
    }

    /**
     * Public URLs of the gallery photos with their pixel size (needed by the PhotoSwipe lightbox).
     *
     * @return array<int, array{src: string, w: int, h: int}>
     */
    public function gallery(): array
    {
        $disk = Storage::disk('public');

        return collect($this->images ?? [])
            ->filter(fn (string $path) => $disk->exists($path))
            ->map(function (string $path) use ($disk) {
                [$w, $h] = @getimagesize($disk->path($path)) ?: [1600, 1200];

                return ['src' => $disk->url($path), 'w' => $w, 'h' => $h];
            })
            ->values()
            ->all();
    }
}
