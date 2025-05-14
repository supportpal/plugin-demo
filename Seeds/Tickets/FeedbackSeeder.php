<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\Core\Models\Condition;
use App\Modules\Core\Models\ConditionGroup;
use App\Modules\Core\Models\CustomField;
use App\Modules\Core\Models\EmailTemplate;
use App\Modules\Core\Models\FeedbackRating;
use App\Modules\Ticket\Models\Department;
use App\Modules\Ticket\Models\Ticket;
use App\Modules\User\Models\User;
use DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();
        
        $form = DB::table('ticket_feedback_form')->insertGetId([
            [
                'name'                 => 'Support & billing feedback',
                'description'          => 'Feedback form for support and billing tickets.',
                'email_template_id'    => EmailTemplate::USER_FEEDBACK_REQUEST,
                'time_after_resolved'  => 86400,
                'expiry_time'          => 604800,
                'condition_group_type' => ConditionGroup::ALL,
                'created_at'           => $time,
                'updated_at'           => $time
            ]
        ]);

        // Insert condition group
        $group = DB::table('ticket_feedback_form_condition_group')->insertGetId([
            'form_id'     => $form,
            'type'        => ConditionGroup::ANY,
            'created_at'  => $time,
            'updated_at'  => $time,
        ]);

        // Insert condition
        DB::table('ticket_feedback_form_condition')->insert([
            [
                'group_id'    => $group,
                'item'        => Condition::TICKET_DEPARTMENT,
                'operator'    => Condition::OPERATOR_EQUALS,
                'value'       => Department::where('name', 'Support')->firstOrFail()->id,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'group_id'    => $group,
                'item'        => Condition::TICKET_DEPARTMENT,
                'operator'    => Condition::OPERATOR_EQUALS,
                'value'       => Department::where('name', 'Billing')->firstOrFail()->id,
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert field
        $field = DB::table('ticket_feedback_form_field')->insertGetId([
            'form_id'     => $form,
            'name'        => 'Any additional comments or thoughts on this support ticket.',
            'type'        => CustomField::TEXTAREA,
            'created_at'  => $time,
            'updated_at'  => $time,
        ]);

        // Insert feedback entry for ticket
        $log = DB::table('ticket_feedback_log')->insert([
            'ticket_id'       => Ticket::where('number', 'SALES-03139')->firstOrFail()->id,
            'form_id'         => $form,
            'token'           => 'fkWr0sNpEE4hFrIU5uG8C2JIijkIZ7CG',
            'rating'          => FeedbackRating::GOOD->value,
            'fields_answered' => 1,
            'expiry_time'     => null,
            'created_at'      => $time,
            'updated_at'      => $time,
        ]);

        // Insert comment for feedback entry
        DB::table('ticket_feedback_form_field_value')->insert([
            [
                'field_id'    => $field,
                'feedback_id' => $log,
                'value'       => 'We managed to solve this, but thank you for the quick reply.',
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert activity log entry
        $operator = User::operator()->firstOrFail();
        DB::table('activity_log')->insert([
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'Support & billing feedback',
                'rel_id'        => $form,
                'rel_route'     => 'ticket.operator.feedbackform.edit',
                'section'       => 'general.form',
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
