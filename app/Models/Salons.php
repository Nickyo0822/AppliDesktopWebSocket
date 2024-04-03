<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salons extends Model
{
    protected $fillable = ['name', 'image', 'user_id'];
}
?>