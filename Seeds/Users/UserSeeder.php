<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Patrick Mason part of organisation 1
        DB::table('user')->insert([
            [
                'brand_id'      => 1,
                'firstname'     => 'Patrick', // Registered via operator
                'lastname'      => 'Mason',
                'email'         => 'user@demo.com',
                'password'      => Hash::make('demo'),
                'confirmed'     => 1,
                'organisation_id'   => 1,
                'organisation_access_level' => 0,
                'country'       => 'GB',
                'language_code' => 'en',
                'timezone'      => 'Europe/London',
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'brand_id'      => 2,
                'firstname'     => 'Patrick', // Registered via operator
                'lastname'      => 'Mason',
                'email'         => 'user@demo.com',
                'password'      => Hash::make('branddemo'),
                'confirmed'     => 1,
                'organisation_id'   => null,
                'organisation_access_level' => null,
                'country'       => 'GB',
                'language_code' => 'en',
                'timezone'      => 'Europe/London',
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'brand_id'      => 1,
                'firstname'     => 'Joe', // Registered via frontend
                'lastname'      => 'Bloggs',
                'email'         => 'joe@bloggs.corp',
                'password'      => null,
                'confirmed'     => 0,
                'organisation_id'   => null,
                'organisation_access_level' => null,
                'country'       => 'GB',
                'language_code' => 'en',
                'timezone'      => 'Europe/London',
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'brand_id'      => 1,
                'firstname'     => 'Jane', // Registered via operator
                'lastname'      => 'Mason',
                'email'         => 'jane.mason@acme.corp',
                'password'      => null,
                'confirmed'     => 0,
                'organisation_id'   => 1,
                'organisation_access_level' => 1,
                'country'       => 'GB',
                'language_code' => 'en',
                'timezone'      => 'Europe/London',
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'brand_id'      => 2,
                'firstname'     => 'Barry', // Registered via frontend
                'lastname'      => 'Klein',
                'email'         => 'bklein@echo.xyz',
                'password'      => null,
                'confirmed'     => 1,
                'organisation_id'   => 2,
                'organisation_access_level' => 0,
                'country'       => 'US',
                'language_code' => 'en',
                'timezone'      => 'America/New_York',
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'brand_id'      => 1,
                'firstname'     => 'Clare', // Registered via operator
                'lastname'      => 'Anderson',
                'email'         => 'andersonc@myemail.com',
                'password'      => null,
                'confirmed'     => 1,
                'organisation_id'   => null,
                'organisation_access_level' => null,
                'country'       => 'GB',
                'language_code' => 'en',
                'timezone'      => 'Europe/London',
                'created_at'    => time(),
                'updated_at'    => time()
            ],
        ]);
        
        // Add custom field values.
        DB::table('user_customfield_value')->insert([
            [ 'field_id' => 1, 'user_id' => 3, 'value' => '123 Arctic Drive', 'created_at' => time(), 'updated_at' => time() ],
            [ 'field_id' => 3, 'user_id' => 3, 'value' => 'AR3 T1C', 'created_at' => time(), 'updated_at' => time() ],
            [ 'field_id' => 4, 'user_id' => 3, 'value' => 'Google', 'created_at' => time(), 'updated_at' => time() ],
            [ 'field_id' => 4, 'user_id' => 5, 'value' => 'Referral by another client', 'created_at' => time(), 'updated_at' => time() ],
            [ 'field_id' => 4, 'user_id' => 7, 'value' => 'Seen on TV', 'created_at' => time(), 'updated_at' => time() ],
        ]);
        
        // Associate with user groups.
        DB::table('user_membership')->insert([
            [ 'user_id' => 3, 'group_id' => 2 ],
            [ 'user_id' => 6, 'group_id' => 2 ],
            [ 'user_id' => 7, 'group_id' => 2 ],
            [ 'user_id' => 7, 'group_id' => 3 ],
        ]);

        // Update organisation owners
        DB::table('user_organisation')->where('id', 1)->update([ 'owner_id' => 3 ]);
        DB::table('user_organisation')->where('id', 2)->update([ 'owner_id' => 6 ]);

        DB::table('activity_log')->insert([
            [
                'type'          => 1,
                'rel_name'      => 'Patrick Mason',
                'rel_id'        => 3,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'Patrick Mason',
                'rel_id'        => 4,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 2,
                'rel_name'      => 'Joe Bloggs',
                'rel_id'        => 5,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => 5,
                'user_name'     => 'Joe Bloggs',
                'event_name'    => 'user_registered',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'Jane Mason',
                'rel_id'        => 6,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'Barry Klein',
                'rel_id'        => 7,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'Clare Anderson',
                'rel_id'        => 8,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
        ]);
    }
}
