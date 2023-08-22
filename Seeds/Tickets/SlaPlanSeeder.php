<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

class SlaPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sla_plan')->insert([
            [
                'name'        => 'Technical Support',
                'description' => 'We guarantee to resolve technical support tickets within time limits.',
                'created_at'  => time(),
                'updated_at'  => time()
            ]
        ]);

        // Insert reply/resolution times
        DB::table('sla_priority_time')->insert([
            [
                'plan_id'      => 1,
                'priority_id'  => 1,
                'first_reply_time'   => 86400,
                'resolve_time' => 604800
            ],
            [
                'plan_id'      => 1,
                'priority_id'  => 2,
                'first_reply_time'   => 64800,
                'resolve_time' => 345600
            ],
            [
                'plan_id'      => 1,
                'priority_id'  => 3,
                'first_reply_time'   => 43200,
                'resolve_time' => 172800
            ],
            [
                'plan_id'      => 1,
                'priority_id'  => 4,
                'first_reply_time'   => 14400,
                'resolve_time' => 86400
            ]
        ]);

        // Insert condition group
        DB::table('sla_condition_group')->insert([
            [
                'plan_id'     => 1,
                'type'        => 0,
                'created_at'  => time(),
                'updated_at'  => time()
            ]
        ]);

        // Insert condition
        DB::table('sla_condition')->insert([
            [
                'group_id'    => 1,
                'item'        => 7,
                'operator'    => 0,
                'value'       => 1,
                'created_at'  => time(),
                'updated_at'  => time()
            ]
        ]);

        // Insert escalation rules
        DB::table('sla_escalation_rule')->insert([
            [
                'plan_id'     => 1,
                'action'      => 0,
                'when'        => 1,
                'when_time'   => 3600,
                'value_id'    => 1,
                'value_text'  => 'Ticket is getting close to overdue, please review.',
                'created_at'  => time(),
                'updated_at'  => time()
            ],
            [
                'plan_id'     => 1,
                'action'      => 3,
                'when'        => 0,
                'when_time'   => null,
                'value_id'    => 1,
                'value_text'  => null,
                'created_at'  => time(),
                'updated_at'  => time()
            ]
        ]);

        // Insert activity log entry
        DB::table('activity_log')->insert([
            [
                'type'          => 1,
                'rel_name'      => 'Technical Support',
                'rel_id'        => 1,
                'rel_route'     => 'ticket.operator.slaplan.edit',
                'section'       => 'ticket.plan',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ]
        ]);
    }
}
