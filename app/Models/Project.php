<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Semua harus di dalam sini
    protected $fillable = ['title', 'client_id', 'budget', 'deadline', 'status', 'notes'];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}