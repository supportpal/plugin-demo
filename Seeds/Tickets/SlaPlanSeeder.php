<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\Core\Models\Condition;
use App\Modules\Core\Models\ConditionGroup;
use App\Modules\Ticket\Models\Action;
use App\Modules\Ticket\Models\Department;
use App\Modules\Ticket\Models\Priority;
use App\Modules\User\Models\User;
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
        $plan = DB::table('sla_plan')->insertGetId([
            'name'        => 'Technical Support',
            'description' => 'We guarantee to resolve technical support tickets within time limits.',
            'created_at'  => time(),
            'updated_at'  => time(),
        ]);

        // Insert reply/resolution times
        DB::table('sla_priority_time')->insert([
            [
                'plan_id'      => $plan,
                'priority_id'  => Priority::where('name', 'Low')->firstOrFail()->id,
                'first_reply_time'   => 86400,
                'resolve_time' => 604800
            ],
            [
                'plan_id'      => $plan,
                'priority_id'  => Priority::where('name', 'Medium')->firstOrFail()->id,
                'first_reply_time'   => 64800,
                'resolve_time' => 345600
            ],
            [
                'plan_id'      => $plan,
                'priority_id'  => Priority::where('name', 'High')->firstOrFail()->id,
                'first_reply_time'   => 43200,
                'resolve_time' => 172800
            ],
            [
                'plan_id'      => $plan,
                'priority_id'  => Priority::where('name', 'Critical')->firstOrFail()->id,
                'first_reply_time'   => 14400,
                'resolve_time' => 86400
            ]
        ]);

        // Insert condition group
        $group = DB::table('sla_condition_group')->insertGetId([
            'plan_id'     => $plan,
            'type'        => ConditionGroup::ALL,
            'created_at'  => time(),
            'updated_at'  => time(),
        ]);

        // Insert condition
        DB::table('sla_condition')->insert([
            [
                'group_id'    => $group,
                'item'        => Condition::TICKET_DEPARTMENT,
                'operator'    => Condition::OPERATOR_EQUALS,
                'value'       => Department::where('name', 'Support')->firstOrFail()->id,
                'created_at'  => time(),
                'updated_at'  => time()
            ]
        ]);

        // Insert escalation rules
        DB::table('sla_escalation_rule')->insert([
            [
                'plan_id'     => $plan,
                'action'      => Action::ADD_NOTE,
                'when'        => 1,
                'when_time'   => 3600,
                'value_id'    => 1,
                'value_text'  => 'Ticket is getting close to overdue, please review.',
                'created_at'  => time(),
                'updated_at'  => time()
            ],
            [
                'plan_id'     => $plan,
                'action'      => Action::ASSIGN_OPERATOR,
                'when'        => 0,
                'when_time'   => null,
                'value_id'    => User::operator()->firstOrFail()->id,
                'value_text'  => null,
                'created_at'  => time(),
                'updated_at'  => time()
            ]
        ]);

        // Insert activity log entry
        $operator = User::operator()->firstOrFail();
        DB::table('activity_log')->insert([
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'Technical Support',
                'rel_id'        => $plan,
                'rel_route'     => 'ticket.operator.slaplan.edit',
                'section'       => 'ticket.plan',
                'user_id'       => $operator->id,
                'user_name'     => $operator->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ]
        ]);
    }
}
