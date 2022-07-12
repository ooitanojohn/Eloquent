<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        //  movie seeder 呼び出し
        $this->call([
            MovieSeeder::class,
            SheetSeeder::class,
            ScheduleSeeder::class,
            ScreenSeeder::class,
        ]);
    }
}
