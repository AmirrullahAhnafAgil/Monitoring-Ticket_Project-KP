<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketsLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'aksi',
        'keterangan',
    ];

    // Relasi ke tiket
    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }

    // Relasi ke user (admin/user yang melakukan aksi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}