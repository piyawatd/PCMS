<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function getShippingAttribute(){
        return Addresses::where('customer',$this->id)->where('type','shipping')->first();
    }

    public function getBillingAttribute(){
        return Addresses::where('customer',$this->id)->where('type','billing')->first();
    }
}
