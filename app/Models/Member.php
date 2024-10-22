<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable

{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'email', 'password'];

    public function borrowingRecords()
    {
        return $this->hasMany(BorrowingRecord::class);
    }
}
