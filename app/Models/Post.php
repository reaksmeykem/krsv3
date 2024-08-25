<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'excerpt',
        'category_id',
        'body',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'view_count',
        'thumbnail_path',
        'user_id',
        'published_at',
        'allow_comment',
        'is_featured',
        'ordering',
        'published_by',
        'edited_by',
        'read_time',
        'postId',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
