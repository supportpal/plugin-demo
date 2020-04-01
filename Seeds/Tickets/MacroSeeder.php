<?php
/**
 * File MacroSeeder.php
 *
 * @package    App\Plugins\Demo\Seeds\Tickets
 */
namespace App\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class MacroSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Tickets
 */
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
        
        DB::table('ticket_macro')->insert([
            [
                'name'        => 'Mark as resolved',
                'description' => 'Closes ticket and sends a final message to the user.',
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);


        // Insert condition group
        DB::table('ticket_macro_condition_group')->insert([
            [
                'macro_id'    => 1,
                'type'        => 0,
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert condition
        DB::table('ticket_macro_condition')->insert([
            [
                'group_id'    => 1,
                'item'        => 13,
                'operator'    => 1,
                'value'       => 2,
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert actions
        DB::table('ticket_macro_action')->insert([
            [
                'macro_id'    => 1,
                'action'      => 9,
                'value_id'    => 2,
                'value_text'  => null,
                'created_at'  => $time,
                'updated_at'  => $time
            ],
            [
                'macro_id'    => 1,
                'action'      => 1,
                'value_id'    => 1,
                'value_text'  => 'Hello,<br><br>I am going to mark this ticket as resolved now, please let us know if you need any further help.',
                'created_at'  => $time,
                'updated_at'  => $time
            ]
        ]);

        // Insert activity log entry
        DB::table('activity_log')->insert([
            [
                'type'          => 1,
                'rel_name'      => 'Mark as resolved',
                'rel_id'        => 1,
                'rel_route'     => 'ticket.operator.macro.edit',
                'section'       => 'ticket.macro',
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
