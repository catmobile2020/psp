<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data1 = [
            'name'=>'admin',
            'username'=>'admin',
            'type'=>1,
            'email'=>'m.mohamed@cat.com.eg',
            'password'=>123456,
        ];

        $data2 = [
            'name'=>'novartis',
            'username'=>'novartis',
            'type'=>2,
            'email'=>'novartis@cat.com.eg',
            'password'=>123456,
        ];

        $data3 = [
            'name'=>'marketing',
            'username'=>'marketing',
            'type'=>3,
            'email'=>'marketing@cat.com.eg',
            'password'=>123456,
        ];

        \App\Admin::create($data1);
        \App\Admin::create($data2);
        \App\Admin::create($data3);
    }
}
