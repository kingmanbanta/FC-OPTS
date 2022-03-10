<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequestItem extends Model
{
    use HasFactory;
    public function purchaserequest(){
        return $this->hasOne(PurchaseRequest::class);
    }
    public function item(){
        return $this->hasMany(Item::class);
    }
}
