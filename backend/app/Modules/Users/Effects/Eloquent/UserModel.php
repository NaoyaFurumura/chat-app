<?php

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model{
    protected $table = 'users';
    protected $fillable = ['id', 'auth0_id', 'name', 'email', 'photo_url'];
    protected $keyType = 'string';
    public $incrementing = false;
}