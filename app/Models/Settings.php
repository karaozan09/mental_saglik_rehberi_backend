<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = ['logo','home_image','home_title','home_text','aim_title','aim_text','aim_image','purpose_image','purpose_title','purpose_subheading'];

}
