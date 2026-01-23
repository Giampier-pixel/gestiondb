<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Bouncer;
use App\Models\User;
class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bouncer::role ()->firstOrCreate([
            'name' => 'admin',
            'title' => 'Administrator',
        ]);
        for ($i = 1; $i <= 5; $i++) {
            $user = User::find($i);
            $user->assign('admin');
        }
    }
}
