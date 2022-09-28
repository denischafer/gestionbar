<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
        'amount',
        'categorie_id',
        'status_id',
    ];

    protected $connection = 'gestionbar';

    function __construct()
    {
        $this->connection = session('db_customer');
    }

}
