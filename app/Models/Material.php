<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'name',
        'student_no',
        'akts',
        'kredi',
    ];


    public function scopeFilterByName($q, $search)
    {
        return $q->where('name', 'like', '%' . $search . '%');
    }
}
