<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $guarded=[];
    // protected $dates = [ 'deleted_at' ];

    public function festival(){
        return $this->belongsTo(Festival::class);
    }
}
