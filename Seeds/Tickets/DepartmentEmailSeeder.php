<?php
/**
 * File DepartmentEmailSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class DepartmentEmailSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Tickets
 */
class DepartmentEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        DB::table('department_email')->where('id', 1)->update([
            'address' => 'support@acmeltd.com',
        ]);

        DB::table('department_email')->insert([
            [
                'department_id' => 1,
                'brand_id'      => 2,
                'address'       => 'brandsupport@demo.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => 2,
                'brand_id'      => 1,
                'address'       => 'sales@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => 2,
                'brand_id'      => 1,
                'address'       => 'presales@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => 2,
                'brand_id'      => 2,
                'address'       => 'brandsales@demo.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => 3,
                'brand_id'      => 1,
                'address'       => 'billing@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => 3,
                'brand_id'      => 1,
                'address'       => 'billingteam@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => 3,
                'brand_id'      => 1,
                'address'       => 'invoices@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => 5,
                'brand_id'      => 2,
                'address'       => 'brandservices@demo.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ]
        ]);
    }
}
