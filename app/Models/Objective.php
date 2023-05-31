<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Objective extends Model
{
    use HasFactory;
    protected $fillable = [
        'courses_id',
        'objective',
        'formation_id',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
}
