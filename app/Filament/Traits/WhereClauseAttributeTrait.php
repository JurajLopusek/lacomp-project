<?php

namespace App\Filament\Traits;

trait WhereClauseAttributeTrait
{
    protected ?string $whereClauseAttribute;
    protected ?string $sortClauseAttribute;

    /**
     * @param string $whereColumn
     * @return static
     */
    public function setWhereClauseAttribute(string $whereColumn): static
    {
        if ($whereColumn) {
            $this->whereClauseAttribute = $whereColumn;
        }

        return $this;
    }

    /**
     * @param string|null $whereColumn
     * @return static
     */
    public function setSortClauseAttribute(?string $whereColumn = null): static
    {
        if ($whereColumn) {
            $this->sortClauseAttribute = $whereColumn;
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function getWhereClauseAttribute(): string
    {
        return $this->whereClauseAttribute ?? $this->name;
    }

    /**
     * @return string
     */
    protected function getSortClauseAttribute(): string
    {
        return $this->sortClauseAttribute ?? $this->getWhereClauseAttribute();
    }
}
