<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 *
 * @property $id
 * @property $text
 * @property $post_status
 * @property $scheduled_at
 * @property $published_at
 * @property $remark
 * @property $deleted_at
 * @property $created_at
 * @property $updated_at
 *
 * @property PlatformSync[] $platformSyncs
 * @property PostMedia[] $postMedias
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
 #[Fillable(['text', 'post_status', 'scheduled_at', 'published_at', 'remark'])]
class Post extends Model
{
    use SoftDeletes;

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['text', 'post_status', 'scheduled_at', 'published_at', 'remark'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function platformSyncs()
    {
        return $this->hasMany(\App\Models\PlatformSync::class, 'id', 'post_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postMedias()
    {
        return $this->hasMany(\App\Models\PostMedia::class, 'id', 'post_id');
    }
    
}
