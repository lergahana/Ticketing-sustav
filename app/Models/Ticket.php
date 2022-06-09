<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ticket extends Model
{
    use Sortable, HasFactory, SoftDeletes;

    public $sortable = ['name', 'created_at'];

    protected $fillable = [
        'name',
        'description',
        'id_status',
        'id_client',
        'id_user',
    ];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function agent() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ticket_technicians() {
        return $this->belongsToMany(Ticket::class, 'ticket_technicians', 'id_ticket', 'id_technician')->withTimestamps();
    }

}
