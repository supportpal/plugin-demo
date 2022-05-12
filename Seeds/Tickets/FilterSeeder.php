<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        DB::table('ticket_filter')->insert([
            [
                'name'        => 'All Tickets',
                'all_groups'  => 1,
                'condition_group_type' => 1,
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Update default ticket filter for operator
        DB::table('operator_setting')->where('user_id', 1)->update([ 'default_ticket_filter' => 3 ]);

        // Insert activity log entry
        DB::table('activity_log')->insert([
            [
                'type'          => 1,
                'rel_name'      => 'All Tickets',
                'rel_id'        => 3,
                'rel_route'     => 'ticket.operator.filter.edit',
                'section'       => 'ticket.filter',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time
            ]
        ]);
    }
}
