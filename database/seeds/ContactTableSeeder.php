<?php

use App\Models\Contact;
use Illuminate\Database\Seeder;
class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'phone' => '(+84)123456789',
            'email' => 'recruitment_uit@gmail.com',
            'location' => 'University Of Information Technology',
            'fb' => 'fb.com/recruitment_uit'
        ]);
    }
}
