<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTestPackage extends Model
{
    use HasFactory;
    public function model_tests(){
        return $this->hasMany(ModelTest::class)->with('subject')->with('level')->orderBy('id', 'desc');
    }
    public function question_banks(){
        return $this->hasMany(QuestionBank::class)->with('subject')->with('level')->orderBy('id', 'desc');;
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function level(){
        return $this->belongsTo(Level::class);
    }
}
