<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;
    public function model_tests(): HasMany
    {
        return $this->hasMany(ModelTest::class);
    }
    public function question_banks(){
        return $this->hasMany(QuestionBank::class);
    }
    public function model_test_packages(){
        return $this->hasMany(ModelTestPackage::class);
    }
}
