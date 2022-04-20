<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanvassItem extends Model
{
    use HasFactory;
    public function canvass(){
        return $this->belongsTo(Canvass::class);
    }
}
