<?php

namespace App\Models;

use App\Traits\MultiLanguage;
use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model
{
    use MultiLanguage;

    protected $fillable = [
        'name_en', 'name_th','detail_th', 'detail_en',
    ];
    /**
     * This array will have the attributes which you want it to support multi languages
     */
    protected $table = 'category_contents';
    protected $multi_lang = [
        'name','detail'
    ];
}
