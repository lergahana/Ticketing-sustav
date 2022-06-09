<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketTechnician extends Model
{
    use HasFactory, Sortable;

    public $sortable = ['id_ticket', 'id_technician'];

    protected $fillable = [
        'id_ticket',
        'id_technician',
    ];

    public $table = "tickets_technicians";
}
