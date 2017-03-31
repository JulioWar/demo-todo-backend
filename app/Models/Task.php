<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        "task",
        "date",
        "due_date",
        "done"
    ];
}
