<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationChat extends Model
{
    use HasFactory;

    protected $table = 'relationchats';

    protected $fillable = [
        'uuid',
        'userA',
        'userB'
    ];

}
