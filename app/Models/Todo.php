<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['id', 'title', 'description', 'status', 'created_at', 'updated_at'];
    public $incrementing = false;
    protected $keyType = 'string';
}