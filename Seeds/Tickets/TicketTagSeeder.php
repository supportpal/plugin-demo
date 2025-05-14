<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;

use function inet_pton;
use function now;

class TicketTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $time = now()->getTimestamp();

        $tags = [
            ['name' => 'Feature Request', 'colour' => '#e67e22'],
            ['name' => 'Bug', 'colour' => '#c0392b'],
            ['name' => 'Custom Work', 'colour' => '#16a085'],
            ['name' => 'Logged', 'colour' => '#95a5a6'],
        ];

        $activityLogData = [];
        foreach ($tags as $tag) {
            $tagId = DB::table('ticket_tag')->insertGetId([
                'name'       => $tag['name'],
                'colour'     => $tag['colour'],
                'created_at' => $time,
                'updated_at' => $time,
            ]);
            $activityLogData[] = [
                'rel_id'   => $tagId,
                'rel_name' => $tag['name'],
            ];
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
            'rel_route'     => 'ticket.operator.tag.edit',
            'section'       => 'ticket.tag',
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
