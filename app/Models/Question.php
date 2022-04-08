<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public function model_test(){
        return $this->belongsTo(ModelTest::class);
    }
    public function options(){
        return $this->hasMany(Option::class);
    }
}
