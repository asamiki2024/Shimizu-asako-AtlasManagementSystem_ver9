<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//データベース操作に関するファザードをインポートする。
use Illuminate\Support\Facades\DB;

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
        //22行目インポートしたDSファザードを使用してUsersテーブルを指定
        //23～24行目insertメゾットにUsersテーブルに登録するカラムを入力
        //初期登録不要のものは記述しない。(deleted_at)テーブルにはNULLで表示される。
        DB::table('users')->insert([
            'over_name' => '高橋',
            'under_name' => 'アトラ',
            'over_name_kana' => 'タカハシ',
            'under_name_kana' => 'アトラ',
            'mail_address' => 'atlas2025@co.jp',
            'sex' => '1',
            'birth_day' => '2025-08-17',
            'role' => '1',
            'password' => bcrypt('Atlas2025'),
            'remember_token' => 'NULL',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
