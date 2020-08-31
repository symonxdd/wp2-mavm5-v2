<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Afspraak extends Model
{
    public $table = 'afspraken';
    protected $fillable = ['datum', 'tijdstip'];
}
