<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use HasSEO;

    protected function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->meta_title ? $this->meta_title : $this->title,
            description: $this->meta_description ? $this->meta_description : $this->excerpt,
            author: $this->user->name,
            image: $this->thumbnail_path ? Storage::url($this->thumbnail_path) : null,
            canonical_url: $this->slug,
        );
    }

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
