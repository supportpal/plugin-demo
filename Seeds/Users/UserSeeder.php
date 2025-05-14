<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\Core\Models\Brand;
use App\Modules\User\Models\User;
use App\Modules\User\Models\UserCustomField;
use App\Modules\User\Models\UserGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function inet_pton;
use function now;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = now()->getTimestamp();

        // Patrick Mason part of organisation 1
        $user1 = DB::table('user')->insertGetId([
            'brand_id'      => Brand::where('name', 'SupportPal')->firstOrFail()->id,
            'firstname'     => 'Patrick', // Registered via operator
            'lastname'      => 'Mason',
            'email'         => 'user@demo.com',
            'password'      => Hash::make('demo'),
            'email_verified'     => 1,
            'organisation_id'   => 1,
            'organisation_access_level' => 0,
            'country'       => 'GB',
            'language_code' => 'en',
            'timezone'      => 'Europe/London',
            'created_at'    => $time,
            'updated_at'    => $time
        ]);

        $user2 = DB::table('user')->insertGetId([
            'brand_id'      => Brand::where('name', 'Brand Demo')->firstOrFail()->id,
            'firstname'     => 'Patrick', // Registered via operator
            'lastname'      => 'Mason',
            'email'         => 'user@demo.com',
            'password'      => Hash::make('branddemo'),
            'email_verified'     => 1,
            'organisation_id'   => null,
            'organisation_access_level' => null,
            'country'       => 'GB',
            'language_code' => 'en',
            'timezone'      => 'Europe/London',
            'created_at'    => $time,
            'updated_at'    => $time
        ]);

        $user3 = DB::table('user')->insertGetId([
            'brand_id'      => Brand::where('name', 'SupportPal')->firstOrFail()->id,
            'firstname'     => 'Joe', // Registered via frontend
            'lastname'      => 'Bloggs',
            'email'         => 'joe@bloggs.corp',
            'password'      => null,
            'email_verified'     => 0,
            'organisation_id'   => null,
            'organisation_access_level' => null,
            'country'       => 'GB',
            'language_code' => 'en',
            'timezone'      => 'Europe/London',
            'created_at'    => $time,
            'updated_at'    => $time
        ]);

        $user4 = DB::table('user')->insertGetId([
            'brand_id'      => Brand::where('name', 'SupportPal')->firstOrFail()->id,
            'firstname'     => 'Jane', // Registered via operator
            'lastname'      => 'Mason',
            'email'         => 'jane.mason@acme.corp',
            'password'      => null,
            'email_verified'     => 0,
            'organisation_id'   => 1,
            'organisation_access_level' => 1,
            'country'       => 'GB',
            'language_code' => 'en',
            'timezone'      => 'Europe/London',
            'created_at'    => $time,
            'updated_at'    => $time
        ]);

        $user5 = DB::table('user')->insertGetId([
            'brand_id'      => Brand::where('name', 'Brand Demo')->firstOrFail()->id,
            'firstname'     => 'Barry', // Registered via frontend
            'lastname'      => 'Klein',
            'email'         => 'bklein@echo.xyz',
            'password'      => null,
            'email_verified'     => 1,
            'organisation_id'   => 2,
            'organisation_access_level' => 0,
            'country'       => 'US',
            'language_code' => 'en',
            'timezone'      => 'America/New_York',
            'created_at'    => $time,
            'updated_at'    => $time
        ]);

        $user6 = DB::table('user')->insertGetId([
            'brand_id'      => Brand::where('name', 'SupportPal')->firstOrFail()->id,
            'firstname'     => 'Clare', // Registered via operator
            'lastname'      => 'Anderson',
            'email'         => 'andersonc@myemail.com',
            'password'      => null,
            'email_verified'     => 1,
            'organisation_id'   => null,
            'organisation_access_level' => null,
            'country'       => 'GB',
            'language_code' => 'en',
            'timezone'      => 'Europe/London',
            'created_at'    => $time,
            'updated_at'    => $time
        ]);

        // Add custom field values.
        DB::table('user_customfield_value')->insert([
            [
                'field_id' => UserCustomField::where('name', 'Address 1')->firstOrFail()->id,
                'user_id' => User::where('email', 'user@demo.com')->firstOrFail()->id,
                'value' => '123 Arctic Drive',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'field_id' => UserCustomField::where('name', 'Postal Code')->firstOrFail()->id,
                'user_id' => User::where('email', 'user@demo.com')->firstOrFail()->id,
                'value' => 'AR3 T1C',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'field_id' => UserCustomField::where('name', 'How did you find us?')->firstOrFail()->id,
                'user_id' => User::where('email', 'user@demo.com')->firstOrFail()->id,
                'value' => 'Google',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'field_id' => UserCustomField::where('name', 'How did you find us?')->firstOrFail()->id,
                'user_id' => User::where('email', 'bklein@echo.xyz')->firstOrFail()->id,
                'value' => 'Referral by another client',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'field_id' => UserCustomField::where('name', 'How did you find us?')->firstOrFail()->id,
                'user_id' => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->id,
                'value' => 'Seen on TV',
                'created_at' => $time,
                'updated_at' => $time
            ],
        ]);

        // Associate with user groups.
        DB::table('user_membership')->insert([
            [
                'user_id' => User::operator()->where('email', 'operator2@demo.com')->firstOrFail()->id,
                'group_id' => UserGroup::operator()->where('name', 'Support Team')->firstOrFail()->id,
            ],
            [
                'user_id' => User::where('email', 'joe@bloggs.corp')->firstOrFail()->id,
                'group_id' => UserGroup::user()->where('name', 'VIP')->firstOrFail()->id,
            ],
            [
                'user_id' => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->id,
                'group_id' => UserGroup::user()->where('name', 'VIP')->firstOrFail()->id,
            ],
            [
                'user_id' => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->id,
                'group_id' => UserGroup::user()->where('name', 'Local users')->firstOrFail()->id,
            ],
        ]);

        // Update organisation owners
        DB::table('user_organisation')
            ->where('name', 'ACME Corp.')
            ->update([ 'owner_id' => User::where('email', 'jane.mason@acme.corp')->firstOrFail()->id, ]);
        DB::table('user_organisation')
            ->where('name', 'Echo XYZ LLC')
            ->update([ 'owner_id' => User::where('email', 'joe@bloggs.corp')->firstOrFail()->id, ]);

        DB::table('activity_log')->insert([
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'Patrick Mason',
                'rel_id'        => $user1,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => User::operator()->firstOrFail()->id,
                'user_name'     => User::operator()->firstOrFail()->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'Patrick Mason',
                'rel_id'        => $user2,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => User::operator()->firstOrFail()->id,
                'user_name'     => User::operator()->firstOrFail()->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'type'          => Type::User->value,
                'rel_name'      => 'Joe Bloggs',
                'rel_id'        => $user3,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => $user3,
                'user_name'     => 'Joe Bloggs',
                'event_name'    => 'user_registered',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'Jane Mason',
                'rel_id'        => $user4,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => User::operator()->firstOrFail()->id,
                'user_name'     => User::operator()->firstOrFail()->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'Barry Klein',
                'rel_id'        => $user5,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => User::operator()->firstOrFail()->id,
                'user_name'     => User::operator()->firstOrFail()->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'Clare Anderson',
                'rel_id'        => $user6,
                'rel_route'     => 'user.operator.user.edit',
                'section'       => 'user.user',
                'user_id'       => User::operator()->firstOrFail()->id,
                'user_name'     => User::operator()->firstOrFail()->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time
            ],
        ]);
    }
}
