<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\Core\Models\ConditionGroup;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;

use function inet_pton;
use function now;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = now()->getTimestamp();

        // Insert filter and get its ID
        $filterId = DB::table('ticket_filter')->insertGetId([
            'name'        => 'All Tickets',
            'all_groups'  => 1,
            'condition_group_type' => ConditionGroup::ANY,
            'created_at'  => $time,
            'updated_at'  => $time
        ]);

        $operator = User::operator()->firstOrFail();

        // Update default ticket filter for operator
        DB::table('operator_setting')
            ->where('user_id', $operator->id)
            ->update(['default_ticket_filter' => $filterId]);

        // Insert activity log entry
        DB::table('activity_log')->insert([
            [
                'type'          => Type::Operator,
                'rel_name'      => 'All Tickets',
                'rel_id'        => $filterId,
                'rel_route'     => 'ticket.operator.filter.edit',
                'section'       => 'ticket.filter',
                'user_id'       => $operator->id,
                'user_name'     => $operator->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time
            ]
        ]);
    }
}
