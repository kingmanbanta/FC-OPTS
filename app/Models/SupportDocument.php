<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportDocument extends Model
{
    use HasFactory;
    public function purcahserequest(){
        return $this->belongsTo(Purchaserequest::class);
    }
}
