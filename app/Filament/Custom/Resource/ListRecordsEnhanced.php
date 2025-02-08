<?php

namespace App\Filament\Custom\Resource;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ListRecordsEnhanced extends ListRecords
{
    public const MAX_PER_PAGE = 5000;
    public const STATS_TEXT = 'štatistika';

    /**
     * @param Builder<Model> $query
     * @return Paginator<Model> | CursorPaginator<Model>
     */
    protected function paginateTableQuery(Builder $query): Paginator | CursorPaginator
    {
        $perPage = $this->getTableRecordsPerPage();

        $useSimple = true;
        if (is_string($perPage) && Str::contains($perPage, self::STATS_TEXT)) {
            $perPage = (int)$perPage;
            $useSimple = false;
        }

        if ($perPage === 'all' || $perPage > self::MAX_PER_PAGE) {
            $perPage = self::MAX_PER_PAGE;
        }

        /** @var int|null $pagination */
        $pagination = is_null($perPage) ? null : (int)$perPage;

        if ($useSimple) {
            $records = $query->simplePaginate($pagination);
        } else {
            $records = $query->paginate($pagination);
            $records->onEachSide(1);
        }

        return $records;
    }

    protected function extractTableSearchWords(string $search): array
    {
        return array_filter(
            [trim($search)],
            static fn ($word): bool => filled($word)
        );
    }

    public function getBreadcrumbs(): array
    {
        if (filled($cluster = static::getCluster())) {
            return $cluster::unshiftClusterBreadcrumbs([]);
        }

        return [];
    }
}
