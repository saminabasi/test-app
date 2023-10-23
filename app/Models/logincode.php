<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logincode extends Model
{
    protected $table = '_login_code';
    protected $fillable = ['user_id', 'code'];
    use HasFactory;
}
