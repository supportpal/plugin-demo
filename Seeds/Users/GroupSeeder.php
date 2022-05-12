<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        DB::table('user_group')->insert([
            [
                'name'          => 'VIP',
                'description'   => 'Very Important Persons',
                'colour'        => '#e01212',
                'administrator' => 0,
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'name'          => 'Local users',
                'description'   => 'Users that are located within a 10 mile radius of our office',
                'colour'        => '#4dba1a',
                'administrator' => 0,
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'name'          => 'Support Team',
                'description'   => 'Operators with only support permissions',
                'colour'        => '#8e44ad',
                'administrator' => 1,
                'created_at'    => $time,
                'updated_at'    => $time
            ],
        ]);

        // Assign operator group to Support department.
        DB::table('department_group_membership')->insert([
            'department_id' => 1, 'group_id' => 4
        ]);

        // Associate support team group with role.
        DB::table('group_role_membership')->insert([ 'group_id' => 4, 'role_id' => 2 ]);
        
        // Associate support team group with brands.
        DB::table('brand_operator_group_membership')->insert([
            [ 'brand_id' => 1, 'group_id' => 4 ],
            [ 'brand_id' => 2, 'group_id' => 4 ],
        ]);

        $this->activityLog([
            [ 'rel_id' => 2, 'rel_name' => 'VIP', 'rel_route' => 'user.operator.usergroup.edit', 'section' => 'user.group' ],
            [ 'rel_id' => 3, 'rel_name' => 'Local users', 'rel_route' => 'user.operator.usergroup.edit', 'section' => 'user.group' ],
            [ 'rel_id' => 4, 'rel_name' => 'Support Team', 'rel_route' => 'user.operator.operatorgroup.edit', 'section' => 'user.operator_group' ],
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
