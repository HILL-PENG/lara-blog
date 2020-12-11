<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'blog_user';
    protected $fillable = ['username', 'password', 'email'];
}
