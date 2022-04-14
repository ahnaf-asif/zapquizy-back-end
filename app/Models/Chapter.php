<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public function question_bank(){
        return $this->belongsTo(QuestionBank::class);
    }
    public function questions(){
        return $this->hasMany(Question::class)->orderBy('id', 'desc')->with('options');
    }
}
