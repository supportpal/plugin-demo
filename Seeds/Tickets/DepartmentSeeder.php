<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
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

        DB::table('department')->where('id', 1)->update([
            'description' => 'Have a problem or need any help with the software? Submit your question here.',
            'order' => 3,
        ]);

        DB::table('department')->insert([
            [
                'name'        => 'Sales',
                'description' => 'Considering choosing us and something you\'re unsure on? Contact our sales team, we\'re happy to help!',
                'order'       => 2,
                'parent_id'   => null,
                'public'      => 1,
                'ticket_number_format' => 'SALES-%N{5}',
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'name'        => 'Billing',
                'description' => 'If you have a question about an invoice or a recent payment to us.',
                'order'       => 1,
                'parent_id'   => null,
                'public'      => 1,
                'ticket_number_format' => null,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'name'        => 'Bugs',
                'description' => null,
                'order'       => null,
                'parent_id'   => 1,
                'public'      => 0,
                'ticket_number_format' => null,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'name'        => 'Services',
                'description' => 'Contact us for our professional development, installation or configuration services.',
                'order'       => 4,
                'parent_id'   => null,
                'public'      => 1,
                'ticket_number_format' => null,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
        ]);

        // Assign to brands.
        DB::table('department_brand_membership')->insert([
            [ 'department_id' => 2, 'brand_id' => 1 ],
            [ 'department_id' => 3, 'brand_id' => 1 ],
            [ 'department_id' => 4, 'brand_id' => 1 ],
            [ 'department_id' => 1, 'brand_id' => 2 ],
            [ 'department_id' => 2, 'brand_id' => 2 ],
            [ 'department_id' => 5, 'brand_id' => 2 ],
        ]);

        // Assign operator groups to departments.
        DB::table('department_group_membership')->insert([
            [ 'department_id' => 2, 'group_id' => 1 ],
            [ 'department_id' => 3, 'group_id' => 1 ],
            [ 'department_id' => 4, 'group_id' => 1 ],
        ]);

        // Assign operators to departments.
        DB::table('department_operator_membership')->insert([
            [ 'department_id' => 5, 'user_id' => 1 ],
        ]);

        // Assign priorities to departments
        DB::table('department_priority_membership')->insert([
            [ 'department_id' => 2, 'priority_id' => 1 ],
            [ 'department_id' => 2, 'priority_id' => 2 ],
            [ 'department_id' => 2, 'priority_id' => 3 ],
            [ 'department_id' => 3, 'priority_id' => 1 ],
            [ 'department_id' => 3, 'priority_id' => 2 ],
            [ 'department_id' => 3, 'priority_id' => 3 ],
            [ 'department_id' => 3, 'priority_id' => 4 ],
            [ 'department_id' => 4, 'priority_id' => 1 ],
            [ 'department_id' => 4, 'priority_id' => 2 ],
            [ 'department_id' => 4, 'priority_id' => 3 ],
            [ 'department_id' => 4, 'priority_id' => 4 ],
            [ 'department_id' => 5, 'priority_id' => 1 ],
            [ 'department_id' => 5, 'priority_id' => 2 ],
            [ 'department_id' => 5, 'priority_id' => 3 ],
            [ 'department_id' => 5, 'priority_id' => 4 ],
        ]);

        // Activity Log
        $this->activityLog([
            [ 'rel_id' => 2, 'rel_name' => 'Sales' ],
            [ 'rel_id' => 3, 'rel_name' => 'Billing' ],
            [ 'rel_id' => 4, 'rel_name' => 'Bugs' ],
            [ 'rel_id' => 5, 'rel_name' => 'Services' ],
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
        $default = [
            'type'          => 1,
            'rel_route'     => 'ticket.operator.department.edit',
            'section'       => 'ticket.department',
            'user_id'       => 1,
            'user_name'     => 'John Doe',
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
