<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Account
 *
 * @property $id
 * @property $platform
 * @property $platform_account_id
 * @property $account_name
 * @property $access_token_encrypted
 * @property $is_active
 * @property $remark
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property PlatformSync[] $platformSyncs
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
 #[Fillable(['platform', 'platform_account_id', 'account_name', 'access_token_encrypted', 'is_active', 'remark'])]
class Account extends Model
{
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function platformSyncs()
    {
        return $this->hasMany(\App\Models\PlatformSync::class, 'id', 'account_id');
    }
    
}
