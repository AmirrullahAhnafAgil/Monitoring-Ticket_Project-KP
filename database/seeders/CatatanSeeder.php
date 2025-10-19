<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('catatan')->insert([
            [
                'ticket_id' => 1,
                'admin_id' => 2, // admin@example.com
                'isi_catatan' => 'Bug login sudah diperiksa, terkait session.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ticket_id' => 2,
                'admin_id' => 2,
                'isi_catatan' => 'Chart error karena data kosong, sedang diperbaiki.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}