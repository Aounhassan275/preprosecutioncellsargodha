<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [ 'name' => 'Aoun Hassan',
            'email' => 'admin1@mail.com',
            'type' => '1',
            'password' => Hash::make('1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
            ['name' => 'Aoun Hassan 2',
            'email' => 'admin2@mail.com',
            'type' => '1',
            'password' => Hash::make('1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
        ]);
        DB::table('users')->insert([
            [ 'name' => 'User 1',
            'email' => 'user1@mail.com',
            'password' => Hash::make('1234'),
            'status' => 'active',
            'type' => 'Police Station',
            'phone' => '923XXXXXXXXX',
            'image' => '/profile/311639246735.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
            [ 'name' => 'User 2',
            'email' => 'user2@mail.com',
            'password' => Hash::make('1234'),
            'status' => 'active',
            'type' => 'Prosecution Branch',
            'phone' => '923XXXXXXXXX',
            'image' => '/profile/311639246735.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
            [ 'name' => 'User 3',
            'email' => 'user3@mail.com',
            'password' => Hash::make('1234'),
            'status' => 'active',
            'type' => 'Court',
            'phone' => '923XXXXXXXXX',
            'image' => '/profile/311639246735.jpg',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
        ]);
        DB::table('police_stations')->insert([
            [ 'name' => 'Atta Shaheed'],
            [ 'name' => 'Bhagtanwala'],
            [ 'name' => 'Bhalwal Sadar'],
            [ 'name' => 'Bhalwal City'],
            [ 'name' => 'Bhera'],
            [ 'name' => 'Cantt'],
            [ 'name' => 'City'],
            [ 'name' => 'Factory Area'],
            [ 'name' => 'Jhal Chakian'],
            [ 'name' => 'Jhawarian'],
            [ 'name' => 'Kirana'],
            [ 'name' => 'Kotmomin'],
            [ 'name' => 'Lakisan'],
            [ 'name' => 'Mela'],
            [ 'name' => 'Miani'],
            [ 'name' => 'Midh Rhanjha'],
            [ 'name' => 'Phularwan'],
            [ 'name' => 'Sadar'],
            [ 'name' => 'Sahiwal'],
            [ 'name' => 'Sajid Shaheed'],
            [ 'name' => 'S.Town'],
            [ 'name' => 'Sillanwali'],
            [ 'name' => 'Shahpur City'],
            [ 'name' => 'Shahpur Sadar'],
            [ 'name' => 'Shah Nikdar'],
            [ 'name' => 'Tirkhanwala'],
            [ 'name' => 'Urban Area'],
        ]);
        DB::table('offences')->insert([
            [ 'name' => 'Murder'],
            [ 'name' => 'Robbery'],
            [ 'name' => 'Dacoity'],
            [ 'name' => 'Kidnapping'],
            [ 'name' => 'Theft'],
            [ 'name' => 'Rape'],
            [ 'name' => 'Others'],
        ]);
    }
}
