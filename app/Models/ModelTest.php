<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelTest extends Model
{
    use HasFactory;
    public function level(): BelongsTo{
        return $this->belongsTo(Level::class);
    }
    public function subject(): BelongsTo{
        return $this->belongsTo(Subject::class);
    }
    public function questions(){
        return $this->hasMany(Question::class)->with('options')->orderBy('id', 'desc');
    }
}
