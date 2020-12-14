<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    protected $table = 'customers';
    public $timestamps = false;

    protected $fillable = ['customer_name', 'address'];
}
