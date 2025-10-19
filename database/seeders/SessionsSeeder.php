<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SessionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sessions')->insert([
            'id' => Str::random(40),
            'user_id' => 1,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Seeder/1.0',
            'payload' => '', // boleh kosong untuk testing
            'last_activity' => time(),
        ]);
    }
}