<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingRecord extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'member_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'fine',
        'returned_at',
    ];
    protected $casts = [
        'due_date' => 'date',
    ];

    public function book(){
        return $this->belongsTo(Book::class,'book_id');
    }
    public function member(){
        return $this->belongsTo(Member::class,'member_id');
    }
}
