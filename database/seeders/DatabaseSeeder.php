<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::updateOrCreate(
            ['email' => 'nhannd314@gmail.com'], // Điều kiện tìm kiếm
            [
                'name' => 'Nhan',
                'password' => Hash::make('MatKhau@314!'), // Đặt mật khẩu mặc định
                'role' => UserRole::Admin, // Cột phân quyền của bạn
            ]
        );
    }
}
