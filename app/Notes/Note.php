<?php

namespace App\Notes;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $table = 'notes';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}