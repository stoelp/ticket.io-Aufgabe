<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['eventTitle', 'eventDate', 'eventCity'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
