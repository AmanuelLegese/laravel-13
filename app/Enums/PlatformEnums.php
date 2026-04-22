<?php

namespace App\Enums;

enum PlatformEnums: string
{
    //
    case TELEGRAM = 'telegram';
    case WHATSAPP = 'whatsapp';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
