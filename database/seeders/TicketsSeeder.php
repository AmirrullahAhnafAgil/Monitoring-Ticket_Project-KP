<?php

namespace Database\Seeders;

// Database/Seeders/TicketsSeeder.php
use Illuminate\Database\Seeder;
use App\Models\Tickets;

class TicketsSeeder extends Seeder
{
    public function run()
    {
        Tickets::create([
            'no_tiket'   => 'TCK-0001',
            'user_id'    => 1,
            'aktivitas'  => 'Bug pada form login',
            'deskripsi'  => 'Saat login dengan email valid, tetap muncul error.',
            'status'     => 'open',
        ]);

        Tickets::create([
            'no_tiket'   => 'TCK-0002',
            'user_id'    => 1,
            'aktivitas'  => 'Tampilan dashboard error',
            'deskripsi'  => 'Beberapa chart tidak tampil di dashboard.',
            'status'     => 'open',
        ]);
    }
}