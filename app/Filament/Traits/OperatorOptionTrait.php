<?php

namespace App\Filament\Traits;

trait OperatorOptionTrait
{
    protected ?string $operator = 'like';
    protected bool $whereInOption = false;

    public const OPERATOR_EQUAL = '=';
    public const OPERATOR_LIKE = 'like';

    public function setOperatorLike(): static
    {
        $this->operator = self::OPERATOR_LIKE;

        return $this;
    }

    public function setOperatorEqual(): static
    {
        $this->operator = self::OPERATOR_EQUAL;

        return $this;
    }

    public function getOperator(): ?string
    {
        return $this->operator;
    }

    public function setPossibleWhereIn(bool $possibleWhereIn = true): static
    {
        $this->whereInOption = $possibleWhereIn;

        return $this;
    }

    public function isWhereInOption(): bool
    {
        return $this->whereInOption;
    }
}
