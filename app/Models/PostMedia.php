<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PostMedia
 *
 * @property $id
 * @property $post_id
 * @property $media_type
 * @property $file_url
 * @property $platform_file_id
 * @property $postition
 * @property $remark
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @property Post $post
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
 #[Fillable(['post_id', 'media_type', 'file_url', 'platform_file_id', 'postition', 'remark'])]
class PostMedia extends Model
{
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id', 'id');
    }
    
}
