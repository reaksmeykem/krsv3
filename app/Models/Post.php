<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Post extends Model
{
    use HasFactory;
    use HasSEO;

    protected $fillable = [
        'title','slug','category_id','excerpt',
        'body','thumbnail_path','user_id','allow_comment','published_at','status',
        'view_count','meta_title','meta_description','meta_keywords','is_featured','ordering',
        'published_by','edited_by'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
