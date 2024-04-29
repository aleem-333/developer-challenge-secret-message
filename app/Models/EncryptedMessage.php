<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncryptedMessage extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['id', 'deleted_at', 'updated_at'];
    protected $dates = ['expires_at'];
}
