<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'name',
        'email',
        'position',
        'phone',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
