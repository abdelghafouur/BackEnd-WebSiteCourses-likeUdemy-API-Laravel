<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'correctAnswer',
        'course_id',
    ];
    public function course()
    {
        return $this->belongsTo(Objective::class);
    }
}
