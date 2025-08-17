<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//データベース操作に関するファザードをインポートする。
use Illuminate\Support\Facades\DS;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 国語、数学、英語を追加
        //22行目インポートしたDSファザードを使用してUsersテーブルを指定
        //23～34行目insertメゾットにSubjectsテーブルに登録するカラムを入力
        DS::table('subjects')->insert([
            [
            'subjects' => '国語',
            'created_at' => now(),
            ],
            [
            'subjects' => '数学',
            'created_at' => now(),
            ],
            [
            'subjects' => '英語',
            'created_at' => now(),
            ],
    ]);
    }
}
