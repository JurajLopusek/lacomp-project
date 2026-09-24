<?php

namespace App\Models;

use App\Filament\Interfaces\FilamentLabelInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

/**
 * Realizácia (reference project) shown on the public /realizacie page.
 *
 * @property string $title
 * @property null|string $location
 * @property null|int $year
 * @property null|array<int, string> $tags
 * @property null|string $description
 * @property null|array<int, string> $images paths on the "public" disk
 * @property bool $is_published
 * @property int $sort
 */
class Project extends GeneralModel implements FilamentLabelInterface
{
    protected $table = 'projects';
    protected $fillable = [
        'title',
        'location',
        'year',
        'tags',
        'description',
        'images',
        'is_published',
        'sort',
    ];
    protected $casts = [
        'title' => 'string',
        'location' => 'string',
        'year' => 'integer',
        'tags' => 'array',
        'description' => 'string',
        'images' => 'array',
        'is_published' => 'boolean',
        'sort' => 'integer',
    ];
    protected $appends = [
        'filament_label',
    ];

    protected static function booted(): void
    {
        // keep storage clean: remove photos that were taken out of a project or belonged to a deleted one
        static::updated(static function (Project $project) {
            if ($project->wasChanged('images')) {
                /** @var array<int, string> $old */
                $old = $project->getOriginal('images') ?? [];
                Storage::disk('public')->delete(array_diff($old, $project->images ?? []));
            }
        });
        static::deleted(static function (Project $project) {
            Storage::disk('public')->delete($project->images ?? []);
        });
    }

    public function getFilamentLabelAttribute(): string
    {
        return "#{$this->id} {$this->title}";
    }

    /**
     * @param Builder<Project> $query
     * @return Builder<Project>
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->orderBy('sort')
            ->orderByDesc('year')
            ->orderByDesc('id');
    }

    /**
     * Public URLs of the project photos with their pixel size (needed by the PhotoSwipe lightbox).
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
