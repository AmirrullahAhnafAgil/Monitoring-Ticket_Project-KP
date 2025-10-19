<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    use HasFactory;

    protected $table = 'catatan'; // sesuai nama tabel
    protected $fillable = [
        'ticket_id',
        'admin_id',
        'isi_catatan',
    ];

    // Relasi ke Ticket
    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }

    // Relasi ke User (Admin)
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}