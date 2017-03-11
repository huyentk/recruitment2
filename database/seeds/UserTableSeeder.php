<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'full_name' => 'Trần Khánh Huyền',
            'email' => 'trankhanhhuyen14520393@gmail.com',
            'password' => bcrypt('khanhhuyen'),
            'gender' => 1,
            'address' => 'Đông Hòa, Dĩ An, Bình Dương',
            'role_id' => 3,
        ]);
        User::create([
            'full_name' => 'Nguyễn Thục Đan',
            'email' => 'bon.loves@yahoo.com',
            'password' => bcrypt('thucdan'),
            'gender' => 1,
            'address' => 'Đông Hòa, Dĩ An, Bình Dương',
            'role_id' => 2,
        ]);
        User::create([
            'full_name' => 'Nguyễn Văn Minh',
            'email' => 'thienbinhtim@gmail.com',
            'password' => bcrypt('vanminh'),
            'gender' => 0,
            'address' => 'Hà Nội',
            'role_id' => 2,
        ]);
        User::create([
            'full_name' => 'Phạm Thanh Hưng',
            'email' => '14520393@gm.uit.edu.vn',
            'password' => bcrypt('thanhhung'),
            'gender' => 0,
            'address' => 'Hà Nội',
            'role_id' => 2,
        ]);
        User::create([
            'full_name' => 'Nguyễn Thị Ngọc Trâm',
            'email' => 'tramnguyennt2@gmail.com',
            'password' => bcrypt('ngoctram'),
            'gender' => 1,
            'address' => 'Quận 1, TP HCM',
            'role_id' => 1,
        ]);
        User::create([
            'full_name' => 'Huỳnh Ngọc Đăng',
            'email' => 'ngocdang@gmail.com',
            'password' => bcrypt('ngocdang'),
            'gender' => 0,
            'address' => 'Quận 2, TP HCM',
            'role_id' => 1,
        ]);
    }
}
