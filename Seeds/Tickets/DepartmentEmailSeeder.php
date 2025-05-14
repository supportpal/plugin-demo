<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\Brand;
use App\Modules\Ticket\Models\Department;
use DB;

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

        DB::table('department_email')->update(['address' => 'support@acmeltd.com',]);

        $brand1 = Brand::where('name', 'LIKE', 'SupportPal')->firstOrFail();
        $brand2 = Brand::where('name', 'LIKE', 'Brand Demo')->firstOrFail();
        DB::table('department_email')->insert([
            [
                'department_id' => Department::where('name', 'Support')->firstOrFail()->id,
                'brand_id'      => $brand1->id,
                'address'       => 'brandsupport@demo.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => Department::where('name', 'Sales')->firstOrFail()->id,
                'brand_id'      => $brand1->id,
                'address'       => 'sales@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => Department::where('name', 'Sales')->firstOrFail()->id,
                'brand_id'      => $brand1->id,
                'address'       => 'presales@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => Department::where('name', 'Sales')->firstOrFail()->id,
                'brand_id'      => $brand2->id,
                'address'       => 'brandsales@demo.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => Department::where('name', 'Billing')->firstOrFail()->id,
                'brand_id'      => $brand1->id,
                'address'       => 'billing@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => Department::where('name', 'Billing')->firstOrFail()->id,
                'brand_id'      => $brand1->id,
                'address'       => 'billingteam@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => Department::where('name', 'Billing')->firstOrFail()->id,
                'brand_id'      => $brand1->id,
                'address'       => 'invoices@acmeltd.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'department_id' => Department::where('name', 'Services')->firstOrFail()->id,
                'brand_id'      => $brand2->id,
                'address'       => 'brandservices@demo.com',
                'created_at'    => $time,
                'updated_at'    => $time
            ]
        ]);
    }
}
