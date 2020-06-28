<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use MultiLanguage;

    protected $fillable = [
        'title_en', 'title_th','intro_th','intro_en','detail_th', 'detail_en',
    ];
    /**
     * This array will have the attributes which you want it to support multi languages
     */
    protected $multi_lang = [
        'title','intro','detail'
    ];
}
