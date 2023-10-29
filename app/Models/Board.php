<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = ['title','creator_id'];

    function users() {
        return $this->belongsToMany(User::class);
    }
    
    function tickets() {
        return $this->hasMany(Ticket::class);
    }
    
    function workingTickets() {
        return $this->tickets()->where('status','working');
    }
    
    function doneTickets() {
        return $this->tickets()->where('status','done');
    }
}
