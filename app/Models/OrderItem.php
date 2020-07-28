<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use MultiLanguage;

    protected $fillable = [
        'title_en', 'title_th'];
    /**
     * This array will have the attributes which you want it to support multi languages
     */
    protected $multi_lang = [
        'title'
    ];

    public $timestamps = false;
}
