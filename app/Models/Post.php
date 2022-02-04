<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    //Formateo el valor antes de guardarlo
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = strtoupper($value);
    }

    //Formateo el valor antes de mostrarlo
    public function getTitleAttribute($value)
    {
        return $value;
    }

    //Creo un atributo virtual para mostrarlo
    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }
}
