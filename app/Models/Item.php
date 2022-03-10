<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function purchaserequestitem(){
        return $this->belongsTo(PurchaseRequestItem::class);
    }
}
