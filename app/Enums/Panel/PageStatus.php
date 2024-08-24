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


}
