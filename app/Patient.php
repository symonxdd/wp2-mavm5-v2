<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public $table = 'patienten';
    protected $fillable = ['voornaam', 'naam', 'contact_met_coronavirus'];
}
