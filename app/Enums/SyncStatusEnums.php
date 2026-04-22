<?php

namespace App\Enums;

enum SyncStatusEnums: string
{
    //
    case PENDING = 'pending';
    case SYNCED = 'synced'; 
    case FAILED = 'failed';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
