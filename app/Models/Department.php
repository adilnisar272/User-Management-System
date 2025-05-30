<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit_id'];
    public $timestamps = true;

    public function unit() {
        return $this->belongsTo(Unit::class);
    }
}
