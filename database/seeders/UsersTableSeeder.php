<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //レコードの生成
        //bcryptで脆弱性対策
        User::create([
            'mail_address' => 'atlas@co.jp',
            'password' => bcrypt('Atlas2025')
        ]);
    }
}
