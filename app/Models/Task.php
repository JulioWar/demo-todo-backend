<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //

     protected $fillable = [
        'task', 'due_date', 'date','done'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}

