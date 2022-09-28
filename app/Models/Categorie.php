<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
        'enable',
    ];

    protected $connection = 'gestionbar';

    function __construct()
    {
        $this->connection = session('db_customer');
    }

}
