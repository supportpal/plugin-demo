<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\Core\Models\Brand;
use App\Modules\Ticket\Models\Department;
use App\Modules\Ticket\Models\Priority;
use App\Modules\User\Models\User;
use App\Modules\User\Models\UserGroup;
use DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        DB::table('department')->update([
            'description' => 'Have a problem or need any help with the software? Submit your question here.',
            'order' => 3,
        ]);

        $department2 = DB::table('department')->insertGetId([
            'name'        => 'Sales',
            'description' => 'Considering choosing us and something you\'re unsure on? Contact our sales team, we\'re happy to help!',
            'order'       => 2,
            'parent_id'   => null,
            'public'      => 1,
            'ticket_number_format' => 'SALES-%N{5}',
            'created_at'  => $time,
            'updated_at'  => $time
        ]);

        $department3 = DB::table('department')->insertGetId([
            'name'        => 'Billing',
            'description' => 'If you have a question about an invoice or a recent payment to us.',
            'order'       => 1,
            'parent_id'   => null,
            'public'      => 1,
            'ticket_number_format' => null,
            'created_at'  => $time,
            'updated_at'  => $time
        ]);

        $department4 = DB::table('department')->insertGetId([
            'name'        => 'Bugs',
            'description' => null,
            'order'       => null,
            'parent_id'   => 1,
            'public'      => 0,
            'ticket_number_format' => null,
            'created_at'  => $time,
            'updated_at'  => $time
        ]);

        $department5 = DB::table('department')->insertGetId([
            'name'        => 'Services',
            'description' => 'Contact us for our professional development, installation or configuration services.',
            'order'       => 4,
            'parent_id'   => null,
            'public'      => 1,
            'ticket_number_format' => null,
            'created_at'  => $time,
            'updated_at'  => $time
        ]);

        // Assign to brands.
        $brand1 = Brand::where('name', 'LIKE', 'SupportPal')->firstOrFail();
        $brand2 = Brand::where('name', 'LIKE', 'Brand Demo')->firstOrFail();
        DB::table('department_brand_membership')->insert([
            [ 'department_id' => $department2, 'brand_id' => $brand1->id ],
            [ 'department_id' => $department3, 'brand_id' => $brand1->id ],
            [ 'department_id' => $department4, 'brand_id' => $brand1->id ],
            [
                'department_id' => Department::where('name', 'Support')->firstOrFail()->id,
                'brand_id' => $brand2->id
            ],
            [ 'department_id' => $department2, 'brand_id' => $brand2->id ],
            [ 'department_id' => $department5, 'brand_id' => $brand2->id ],
        ]);

        // Assign operator groups to departments.
        $groupId = UserGroup::where('name', 'System Administrators')->firstOrFail()->id;
        DB::table('department_group_membership')->insert([
            [ 'department_id' => $department2, 'group_id' => $groupId ],
            [ 'department_id' => $department3, 'group_id' => $groupId ],
            [ 'department_id' => $department4, 'group_id' => $groupId ],
        ]);

        // Assign operators to departments.
        DB::table('department_operator_membership')->insert([
            [ 'department_id' => $department5, 'user_id' => User::operator()->firstOrFail()->id ],
        ]);

        // Assign priorities to departments
        $low = Priority::where('name', 'Low')->firstOrFail()->id;
        $medium = Priority::where('name', 'Medium')->firstOrFail()->id;
        $high = Priority::where('name', 'High')->firstOrFail()->id;
        $critical = Priority::where('name', 'Critical')->firstOrFail()->id;
        DB::table('department_priority_membership')->insert([
            [ 'department_id' => $department2, 'priority_id' => $low ],
            [ 'department_id' => $department2, 'priority_id' => $medium ],
            [ 'department_id' => $department2, 'priority_id' => $high ],
            [ 'department_id' => $department3, 'priority_id' => $low ],
            [ 'department_id' => $department3, 'priority_id' => $medium ],
            [ 'department_id' => $department3, 'priority_id' => $high ],
            [ 'department_id' => $department3, 'priority_id' => $critical ],
            [ 'department_id' => $department4, 'priority_id' => $low ],
            [ 'department_id' => $department4, 'priority_id' => $medium ],
            [ 'department_id' => $department4, 'priority_id' => $high ],
            [ 'department_id' => $department4, 'priority_id' => $critical ],
            [ 'department_id' => $department5, 'priority_id' => $low ],
            [ 'department_id' => $department5, 'priority_id' => $medium ],
            [ 'department_id' => $department5, 'priority_id' => $high ],
            [ 'department_id' => $department5, 'priority_id' => $critical ],
        ]);

        // Activity Log
        $this->activityLog([
            [ 'rel_id' => $department2, 'rel_name' => 'Sales' ],
            [ 'rel_id' => $department3, 'rel_name' => 'Billing' ],
            [ 'rel_id' => $department4, 'rel_name' => 'Bugs' ],
            [ 'rel_id' => $department5, 'rel_name' => 'Services' ],
        ]);
    }

    /**
     * Add activity log entries.
     *
     * @param  array $data [ [ 'rel_name' => '', 'rel_id' => '' ], [ .. ] ]
     * @return void
     */
    private function activityLog(array $data)
    {
        $operator = User::operator()->firstOrFail();
        $default = [
            'type'          => Type::Operator->value,
            'rel_route'     => 'ticket.operator.department.edit',
            'section'       => 'ticket.department',
            'user_id'       => $operator->id,
            'user_name'     => $operator->formatted_name,
            'event_name'    => 'item_created',
            'ip'            => inet_pton('81.8.12.192'),
            'created_at'    => time(),
            'updated_at'    => time()
        ];

        foreach ($data as $k => $row) {
            $data[$k] = $row + $default;
        }

        DB::table('activity_log')->insert($data);
    }
}
