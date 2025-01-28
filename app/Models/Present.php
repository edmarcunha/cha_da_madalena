<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'is_selected',
        'selected_by',
    ];
}
