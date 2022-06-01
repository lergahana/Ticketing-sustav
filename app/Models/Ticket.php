<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use Sortable;

    public $sortable = ['name',
                        'id_client'
                        ];

    use HasFactory;
}
