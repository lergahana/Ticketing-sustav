<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolvedTicket extends Model
{

    use HasFactory, Sortable;
    public $sortable = ['id_ticket', 'solved'];
    protected $fillable = [
        'id_ticket',
        'solved',
    ];

}
