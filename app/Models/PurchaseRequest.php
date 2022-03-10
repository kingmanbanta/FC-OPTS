<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;
    public function user(){
        return $this->hasOne(User::class);
    }
    public function purchaserequestitem(){
        return $this->hasMany(PurchaseRequestItem::class);
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}
