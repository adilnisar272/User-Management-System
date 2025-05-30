<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = ['name'];

    public function departments() {
        return $this->hasMany(Department::class);
    }
}
