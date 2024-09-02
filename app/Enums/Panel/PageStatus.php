<?php

namespace App\Enums\Panel;

enum PageStatus: string
{
    case PUBLISHED = 'Published';
    case DRAFT = 'Draft';
    case PRIVATE = 'Private';


    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
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
