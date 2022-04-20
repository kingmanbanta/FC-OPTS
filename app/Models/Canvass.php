<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canvass extends Model
{
    use HasFactory;
    public function canvass_item(){
        return $this->hasMany(CanvassItem::class);
    }
}
