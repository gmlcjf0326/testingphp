<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 관리자 계정 생성
        User::create([
            'name' => '관리자',
            'email' => 'admin@shop.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // 기존 사용자 중 첫 번째 사용자를 관리자로 설정
        $firstUser = User::first();
        if ($firstUser && !$firstUser->is_admin) {
            $firstUser->update(['is_admin' => true]);
        }
    }
}
