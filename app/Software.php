<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    protected $table = 'software';
    protected $dates = ['sw_datesupp','sw_datefac','sw_date_po']; //PENTING BAQ ANG
}
