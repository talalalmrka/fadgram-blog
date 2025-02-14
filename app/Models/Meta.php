<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $fillable = [
        'model_type',
        'model_id',
        'key',
        'value',
    ];
    public function model()
    {
        return $this->morphTo('model');
    }
}
