<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'items';
    public $timestamps = false;
}
