<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'bio', 'birth_date'];

    public function books()
    {
        return $this->hasMany(Book::class, 'author_id'); // Adjust 'category_id' if your foreign key has a different name
    }
}
