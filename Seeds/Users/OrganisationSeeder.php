<?php
/**
 * File OrganisationSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class OrganisationSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Users
 */
class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_organisation')->insert([
            [
                'brand_id'      => 1,
                'name'          => 'ACME Corp.',
                'country'       => 'GB',
                'language_code' => 'en',
                'timezone'      => 'Europe/London',
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'brand_id'      => 2,
                'name'          => 'Echo XYZ LLC',
                'country'       => 'US',
                'language_code' => 'en',
                'timezone'      => 'America/New_York',
                'created_at'    => time(),
                'updated_at'    => time()
            ]
        ]);

        DB::table('activity_log')->insert([
            [
                'type'          => 1,
                'rel_name'      => 'ACME Corp.',
                'rel_id'        => 1,
                'rel_route'     => 'user.operator.organisation.edit',
                'section'       => 'user.organisation',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ]
        ]);
    }
}
