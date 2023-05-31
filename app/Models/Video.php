<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'courses_id',
        'title',
        'link',
        'duration',
    ];
    public function course()
    {
        return $this->belongsTo(Objective::class);
    }
}
