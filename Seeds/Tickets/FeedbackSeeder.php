<?php
/**
 * File FeedbackSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class FeedbackSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Tickets
 */
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
        
        DB::table('ticket_feedback_form')->insert([
            [
                'name'                 => 'Support & billing feedback',
                'description'          => 'Feedback form for support and billing tickets.',
                'email_template_id'    => 25,
                'time_after_resolved'  => 86400,
                'expiry_time'          => 604800,
                'condition_group_type' => 0,
                'created_at'           => $time,
                'updated_at'           => $time
            ]
        ]);

        // Insert condition group
        DB::table('ticket_feedback_form_condition_group')->insert([
            [
                'form_id'     => 1,
                'type'        => 1,
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert condition
        DB::table('ticket_feedback_form_condition')->insert([
            [
                'group_id'    => 1,
                'item'        => 7,
                'operator'    => 0,
                'value'       => 1,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'group_id'    => 1,
                'item'        => 7,
                'operator'    => 0,
                'value'       => 3,
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert field
        DB::table('ticket_feedback_form_field')->insert([
            [
                'form_id'     => 1,
                'name'        => 'Any additional comments or thoughts on this support ticket.',
                'type'        => 9,
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert feedback entry for ticket
        DB::table('ticket_feedback_log')->insert([
            [
                'ticket_id'       => 4,
                'form_id'         => 1,
                'token'           => 'fkWr0sNpEE4hFrIU5uG8C2JIijkIZ7CG',
                'rating'          => 1,
                'fields_answered' => 1,
                'expiry_time'     => null,
                'created_at'      => $time,
                'updated_at'      => $time
            ]
        ]);

        // Insert comment for feedback entry
        DB::table('ticket_feedback_form_field_value')->insert([
            [
                'field_id'    => 1,
                'feedback_id' => 1,
                'value'       => 'We managed to solve this, but thank you for the quick reply.',
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert activity log entry
        DB::table('activity_log')->insert([
            [
                'type'          => 1,
                'rel_name'      => 'Support & billing feedback',
                'rel_id'        => 1,
                'rel_route'     => 'ticket.operator.feedbackform.edit',
                'section'       => 'general.form',
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
