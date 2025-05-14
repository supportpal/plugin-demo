<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\Core\Models\Brand;
use App\Modules\Ticket\Models\Department;
use App\Modules\User\Models\Role;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;

use function inet_pton;
use function now;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = now()->getTimestamp();

        $groups = [
            [
                'data' => [
                    'name'          => 'VIP',
                    'description'   => 'Very Important Persons',
                    'colour'        => '#e01212',
                    'administrator' => 0,
                    'created_at'    => $time,
                    'updated_at'    => $time,
                ],
                'activity' => [
                    'rel_name'  => 'VIP',
                    'rel_route' => 'user.operator.usergroup.edit',
                    'section'   => 'user.group',
                ],
            ],
            [
                'data' => [
                    'name'          => 'Local users',
                    'description'   => 'Users that are located within a 10 mile radius of our office',
                    'colour'        => '#4dba1a',
                    'administrator' => 0,
                    'created_at'    => $time,
                    'updated_at'    => $time,
                ],
                'activity' => [
                    'rel_name'  => 'Local users',
                    'rel_route' => 'user.operator.usergroup.edit',
                    'section'   => 'user.group',
                ],
            ],
            [
                'data' => [
                    'name'          => 'Support Team',
                    'description'   => 'Operators with only support permissions',
                    'colour'        => '#8e44ad',
                    'administrator' => 1,
                    'created_at'    => $time,
                    'updated_at'    => $time,
                ],
                'activity' => [
                    'rel_name'  => 'Support Team',
                    'rel_route' => 'user.operator.operatorgroup.edit',
                    'section'   => 'user.operator_group',
                ],
                'extra' => [
                    'department_group_membership' => ['department_id' => Department::firstOrFail()->id],
                    'group_role_membership'       => ['role_id' => Role::where('name', 'Support Operator')->firstOrFail()->id],
                    'brand_operator_group_membership' => [
                        ['brand_id' => Brand::where('name', 'SupportPal')->firstOrFail()->id],
                        ['brand_id' => Brand::where('name', 'Brand Demo')->firstOrFail()->id],
                    ],
                ],
            ],
        ];

        $activityLogData = [];
        foreach ($groups as $group) {
            $groupId = DB::table('user_group')->insertGetId($group['data']);
            $activityLogData[] = array_merge(['rel_id' => $groupId], $group['activity']);

            if (isset($group['extra'])) {
                if (isset($group['extra']['department_group_membership'])) {
                    DB::table('department_group_membership')
                        ->insert(['group_id' => $groupId] + $group['extra']['department_group_membership']);
                }

                if (isset($group['extra']['group_role_membership'])) {
                    DB::table('group_role_membership')
                        ->insert(['group_id' => $groupId] + $group['extra']['group_role_membership']);
                }

                if (isset($group['extra']['brand_operator_group_membership'])) {
                    foreach ($group['extra']['brand_operator_group_membership'] as $brand) {
                        DB::table('brand_operator_group_membership')
                            ->insert(['group_id' => $groupId] + $brand);
                    }
                }
            }
        }

        $this->activityLog($activityLogData);
    }

    /**
     * Add activity log entries.
     *
     * @param mixed[] $data [ [ 'rel_name' => '', 'rel_id' => '' ], [ .. ] ]
     */
    private function activityLog(array $data): void
    {
        $operator = User::operator()->firstOrFail();

        $default = [
            'type'          => Type::Operator->value,
            'user_id'       => $operator->id,
            'user_name'     => $operator->formatted_name,
            'event_name'    => 'item_created',
            'ip'            => inet_pton('81.8.12.192'),
            'created_at'    => now()->getTimestamp(),
            'updated_at'    => now()->getTimestamp(),
        ];

        foreach ($data as $k => $row) {
            $data[$k] = $row + $default;
        }

        DB::table('activity_log')->insert($data);
    }
}
