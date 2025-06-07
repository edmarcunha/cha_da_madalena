<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Present extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'purchase_link',
        'is_selected',
        'selected_by',
        'selected_by_phone',
    ];
}
