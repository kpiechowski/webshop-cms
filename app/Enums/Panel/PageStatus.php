<?php

namespace App\Enums\Panel;
use Filament\Support\Contracts\HasLabel;

enum PageStatus: string implements HasLabel
{
    case PUBLISHED = 'Published';
    case DRAFT = 'Draft';
    case PRIVATE = 'Private';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public static function toArray(): array
    {
        // dd(array_column(self::cases(), null, 'name'));
        return array_column(self::cases(), 'value');
    }

    public static function toKeyValueArray(): array
    {
        return array_reduce(self::cases(), function ($carry, $case) {
            $carry[$case->value] = $case->value;
            return $carry;
        }, []);
    }

    public function color(): string
    {
        return match ($this) {
            self::PUBLISHED => 'success',
            self::DRAFT => 'warning',
            self::PRIVATE => 'danger',
        };
    }
}
