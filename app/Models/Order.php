<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    //default value
    protected $attributes = [
        'status' => true,
    ];

    public function getCustomerDataAttribute()
    {
        return Customer::find($this->customer);
    }

    public function getItemsAttribute()
    {
        return OrderItem::where("order",$this->id)->get();
    }

    public function getShippingAttribute()
    {

        return OrderAddress::where("order",$this->id)
            ->Where("type","shipping")
            ->first();
    }

    public function getBillingAttribute()
    {
        return OrderAddress::where("order",$this->id)
            ->Where("type","billing")
            ->first();
    }
}
