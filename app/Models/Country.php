<?php
// app/Models/Country.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['code', 'name', 'capital', 'region', 'population'];

    public function getFlagUrlAttribute()
    {
        return "/flags/" . strtolower($this->code) . ".png";
    }
}
