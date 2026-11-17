<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application database.
     * Password default: 'password' -> ganti kalau dipakai di luar development.
     */
    public function run(): void
    {
        // role tidak ada di $fillable, jadi pakai unguarded
        User::unguarded(function () {
            User::updateOrCreate(
                ['email' => 'admin@example.com'],
                ['name' => 'Admin', 'password' => 'password', 'role' => User::ROLE_ADMIN]
            );

            User::updateOrCreate(
                ['email' => 'user@example.com'],
                ['name' => 'User Biasa', 'password' => 'password', 'role' => User::ROLE_USER]
            );
        });
    }
}
