<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
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

        // 시더 실행
        $this->call([
            ProductSeeder::class,
            ProgramSeeder::class,
            TeacherSeeder::class,
            ReviewSeeder::class,
            AdminUserSeeder::class,
            TeacherScheduleSeeder::class,
        ]);
    }
}
