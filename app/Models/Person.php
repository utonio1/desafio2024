<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'birthdate',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'person_id');
    }
}
