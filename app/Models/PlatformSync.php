<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PlatformSync
 *
 * @property $id
 * @property $post_id
 * @property $account_id
 * @property $external_post_id
 * @property $sync_status
 * @property $last_error
 * @property $remark
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Account $account
 * @property Post $post
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
 #[Fillable(['post_id', 'account_id', 'external_post_id', 'sync_status', 'last_error', 'remark'])]
class PlatformSync extends Model
{
    use SoftDeletes;



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'account_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id', 'id');
    }
    
}
