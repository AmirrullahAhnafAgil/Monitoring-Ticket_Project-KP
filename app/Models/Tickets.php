<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    /**
     * Pastikan nama tabel eksplisit
     */
    protected $table = 'tickets';

    protected $fillable = [
        'no_tiket',
        'user_id',
        'aktivitas',
        'deskripsi',
        'status',
    ];

    /**
     * Relasi ke user pembuat tiket
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke log tiket
     */
    public function logs()
    {
        return $this->hasMany(TicketsLogs::class, 'ticket_id');
    }

    /**
     * Auto-generate no_tiket
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            if (empty($ticket->no_tiket)) {
                $lastId = self::max('id') + 1;
                $ticket->no_tiket = 'TCK-' . str_pad($lastId, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}