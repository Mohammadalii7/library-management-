<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;

    public function books()
    {
        return $this->hasMany(Book::class, 'category_id'); // Adjust 'category_id' if your foreign key has a different name
    }
}
