<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'description',
        'staff_id',
        'file_path',
        'status'
    ];
    
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
