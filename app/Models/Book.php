<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'author',
        'publication_date',
        'pdf_path',
        'cover_image_path',
        'isbn',
        'language',
        'publisher',
        'genre',
        'page_count',

        'price',
        'category_id',
        'state',
        'description',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
