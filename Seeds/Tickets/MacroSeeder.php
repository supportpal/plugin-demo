<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\Core\Models\Condition;
use App\Modules\Core\Models\ConditionGroup;
use App\Modules\Ticket\Models\Action;
use App\Modules\Ticket\Models\Status;
use App\Modules\User\Models\User;
use DB;

class MacroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();
        
        $macro = DB::table('ticket_macro')->insertGetId([
            'name'        => 'Mark as resolved',
            'description' => 'Closes ticket and sends a final message to the user.',
            'created_at'  => $time,
            'updated_at'  => $time,
        ]);


        // Insert condition group
        $group = DB::table('ticket_macro_condition_group')->insertGetId([
            'macro_id'    => $macro,
            'type'        => ConditionGroup::ALL,
            'created_at'  => $time,
            'updated_at'  => $time,
        ]);

        // Insert condition
        DB::table('ticket_macro_condition')->insert([
            [
                'group_id'    => $group,
                'item'        => Condition::TICKET_STATUS,
                'operator'    => Condition::OPERATOR_NOT_EQUALS,
                'value'       => Status::where('name', 'Closed')->firstOrFail()->id,
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert actions
        DB::table('ticket_macro_action')->insert([
            [
                'macro_id'    => $macro,
                'action'      => Action::UPDATE_STATUS,
                'value_id'    => Status::where('name', 'Closed')->firstOrFail()->id,
                'value_text'  => null,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'macro_id'    => $macro,
                'action'      => Action::ADD_REPLY,
                'value_id'    => 1,
                'value_text'  => 'Hello,<br><br>I am going to mark this ticket as resolved now, please let us know if you need any further help.',
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert activity log entry
        $operator = User::operator()->firstOrFail();
        DB::table('activity_log')->insert([
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'Mark as resolved',
                'rel_id'        => $macro,
                'rel_route'     => 'ticket.operator.macro.edit',
                'section'       => 'ticket.macro',
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
