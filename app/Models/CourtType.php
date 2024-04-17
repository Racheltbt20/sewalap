<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourtType extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // relation
    public function court() {
        return $this->hasMany(Court::class);
    }
}
