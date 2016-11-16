<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    protected $table = 'hardware';
    protected $fillable = [
  	'hw_asset',
  	'hw_serialno',
  	'hw_model',
		'hw_po_no',
		'hw_date_po',
		'hw_supplier',
		'hw_part_no',
		'hw_price',
		'hw_type',
		'hw_datesupp',
		'hw_datefac'
    ];
}
