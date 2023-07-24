<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundVerification extends Model
{
    use HasFactory;
    protected $table='background_verification';
    protected $guarded=[];
}
