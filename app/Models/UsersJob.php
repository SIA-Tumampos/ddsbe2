<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UsersJob extends Model
{
    protected $table = 'usersjob'; 

    protected $fillable = [
        'jobid', 'jobname',
    ];

    public $timestamps = false;
    protected $primaryKey = 'jobid';
}