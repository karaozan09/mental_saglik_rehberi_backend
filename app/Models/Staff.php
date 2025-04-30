<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $guarded=[];

    public function jobs()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }
}
