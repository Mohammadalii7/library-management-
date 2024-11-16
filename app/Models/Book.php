<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
    public function borrowingRecords()
    {
        return $this->hasMany(BorrowingRecord::class, 'book_id');
    }

    
}
