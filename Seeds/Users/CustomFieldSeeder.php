<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;

use function array_merge;
use function inet_pton;
use function now;

class CustomFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = now()->getTimestamp();

        $fields = [
            ['name' => 'Address 1', 'type' => 8, 'order' => 1],
            ['name' => 'Address 2', 'type' => 8, 'order' => 2],
            ['name' => 'Postal Code', 'type' => 8, 'order' => 1],
            ['name' => 'How did you find us?', 'type' => 8, 'order' => 1],
        ];

        $activityLogData = [];
        $brandMembershipData = [];

        foreach ($fields as $index => $field) {
            $fieldId = DB::table('user_customfield')->insertGetId(array_merge($field, [
                'created_at' => $time,
                'updated_at' => $time,
            ]));

            $activityLogData[] = [
                'rel_id'   => $fieldId,
                'rel_name' => $field['name'],
            ];

            $brandMembershipData[] = [
                'field_id' => $fieldId,
                'brand_id' => 1,
            ];
        }

        DB::table('user_customfield_brand_membership')->insert($brandMembershipData);
        $this->activityLog($activityLogData);
    }

    /**
     * Add activity log entries.
     *
     * @param mixed[] $data [ [ 'rel_name' => '', 'rel_id' => '' ], [ .. ] ]
     * @return void
     */
    private function activityLog(array $data): void
    {
        $operator = User::operator()->firstOrFail();

        $default = [
            'type'          => Type::Operator,
            'rel_route'     => 'user.operator.customfield.edit',
            'section'       => 'user.customfield',
            'user_id'       => $operator->id,
            'user_name'     => $operator->formatted_name,
            'event_name'    => 'item_created',
            'ip'            => inet_pton('81.8.12.192'),
            'created_at'    => now()->getTimestamp(),
            'updated_at'    => now()->getTimestamp()
        ];

        foreach ($data as $k => $row) {
            $data[$k] = $row + $default;
        }

        DB::table('activity_log')->insert($data);
    }
}
