<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;
    public function chapters(){
        return $this->hasMany(Chapter::class)->orderBy('id', 'desc')->with('questions');
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function level(){
        return $this->belongsTo(Level::class);
    }
    public function model_test_package(){
        return $this->belongsTo(ModelTestPackage::class);
    }
}
