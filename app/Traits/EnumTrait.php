<?php

namespace App\Traits;

trait EnumTrait
{
    public static function all(): array
    {
        $arr = [];
        foreach (self::cases() as $case) {
            $arr[$case->value] = $case->toOption();
        }

        return $arr;
    }

    public function toArray(): array
    {
        return
            [
                'id' => $this->value,
                'name' => $this->name(),
            ];
    }

    public static function options(): array
    {
        $arr = [];
        foreach (self::cases() as $case) {
            $arr[] = $case->toOption();
        }

        return $arr;
    }

    public function toOption(): array
    {
        return
            [
                $this->value => $this->name(),
            ];
    }

    public function name(): mixed
    {
        return $this->name;
    }

    public static function filamentOptions($fn = 'name'): array
    {
        $arr = [];
        foreach (self::cases() as $case) {
            $arr[$case->value] = method_exists($case, $fn) ? $case->{$fn}() : $case->{$fn};
        }

        return $arr;
    }

    public function isTypeOf($type): bool
    {
        return $this === $type;
    }

    public static function findByValue(string|int|null $value): null|self
    {
        foreach (self::cases() as $case) {
            if ($case->value == $value) {
                return $case;
            }
        }

        return null;
    }

    public static function findByName(string $name): null|self
    {
        foreach (self::cases() as $case) {
            if ($case->name() == $name) {
                return $case;
            }
        }

        return null;
    }
}
