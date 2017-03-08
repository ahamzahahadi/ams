<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    protected $table = 'hardware';
    protected $dates = ['hw_datesupp','hw_datefac','hw_date_po'];
    protected $fillable = [
  	'hw_assetid',
  	'hw_serialno',
  	'hw_model',
		'hw_po_no',
		'hw_date_po',
		'hw_supplier',
		'hw_part_no',
		'hw_price',
		'hw_type',
		'hw_datesupp',
    'hw_company',
    'hw_class',
    'hw_datefac'
    ];
}
