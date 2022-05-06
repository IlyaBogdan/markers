<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model {

    protected $table = "markers";

    protected $fillable = [
        'id',
        'mobile',
        'description',
        'x',
        'y'
    ];
}
