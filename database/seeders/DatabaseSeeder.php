<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Register your seeders here
        //複数seederクラスをまとめて実行する役割がある。
        //run()が実行されるとcall()のメゾット内に指定されたSeederクラスが順々に呼ばれてデータベースに登録されていきます。
        $this->call([
        [
            UsersTableSeeder::class
        ],
        [
            SubjectsTableSeeder::class
        ],
        ]);
    }
}
