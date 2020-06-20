<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use MultiLanguage;

    protected $fillable = [
        'name_en', 'name_th','image_en', 'image_th',
    ];
    /**
     * This array will have the attributes which you want it to support multi languages
     */
    protected $multi_lang = [
        'name','image'
    ];
}
