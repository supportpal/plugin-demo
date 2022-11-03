<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\User\Models\User;
use DB;
use Hash;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operator = DB::table('user')->insertGetId([
            'brand_id'      => null,
            'firstname'     => 'Shaun',
            'lastname'      => 'Davies',
            'email'         => 'operator2@demo.com',
            'password'      => Hash::make('demo'),
            'confirmed'     => 1,
            'country'       => 'GB',
            'language_code' => 'en',
            'timezone'      => 'Europe/London',
            'created_at'    => time(),
            'updated_at'    => time()
        ]);

        User::find($operator)->convertToOperator([], [ 4 ]);

        DB::table('activity_log')->insert([
            'type'          => 1,
            'rel_name'      => 'Shaun Davies',
            'rel_id'        => 2,
            'rel_route'     => 'user.operator.operator.edit',
            'section'       => 'general.operator',
            'user_id'       => 1,
            'user_name'     => 'John Doe',
            'event_name'    => 'item_created',
            'ip'            => inet_pton('81.8.12.192'),
            'created_at'    => time(),
            'updated_at'    => time()
        ]);

        DB::table('operator_reply_template')->insert([
            [
                'user_id'       => 1,
                'brand_id'      => null,
                'department_id' => null,
                'contents'      => '-----<br>Best Regards,<br><br>John Doe<br><strong>{{ brand.name }}</strong>',
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'user_id'       => 1,
                'brand_id'      => null,
                'department_id' => 1,
                'contents'      => '-----<br>Best Regards,<br><br>John Doe<br><strong>{{ brand.name }}</strong><br><br>Follow us on Twitter @DemoAccount to get the latest service updates.',
                'created_at'    => time(),
                'updated_at'    => time(),
            ],
            [
                'user_id'       => 1,
                'brand_id'      => 2,
                'department_id' => null,
                'contents'      => '-----<br>Best Regards,<br>John @ {{ brand.name }}',
                'created_at'    => time(),
                'updated_at'    => time(),
            ],
            [
                'user_id'       => 2,
                'brand_id'      => null,
                'department_id' => null,
                'contents'      => '-----<br>Best Regards,<br><br>Shaun Davies<br><strong>{{ brand.name }}</strong>',
                'created_at'    => time(),
                'updated_at'    => time(),
            ]
        ]);
    }
}
