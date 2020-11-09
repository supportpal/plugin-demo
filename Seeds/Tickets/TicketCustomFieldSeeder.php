<?php
/**
 * File TicketCustomFieldSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class TicketCustomFieldSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Tickets
 */
class TicketCustomFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_customfield')->insert([
            [
                'name'       => 'Installed Version',
                'type'       => 5,
                'order'      => 1,
                'required'   => 1,
                'public'     => 1,
                'encrypted'  => 0,
                'purge'      => 0,
                'locked'     => 0,
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'name'       => 'Installation URL',
                'type'       => 8,
                'order'      => 2,
                'required'   => 1,
                'public'     => 1,
                'encrypted'  => 0,
                'purge'      => 0,
                'locked'     => 0,
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'name'       => 'FTP Username',
                'type'       => 8,
                'order'      => 3,
                'required'   => 0,
                'public'     => 1,
                'encrypted'  => 1,
                'purge'      => 1,
                'locked'     => 0,
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'name'       => 'FTP Password',
                'type'       => 6,
                'order'      => 4,
                'required'   => 0,
                'public'     => 1,
                'encrypted'  => 1,
                'purge'      => 1,
                'locked'     => 0,
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'name'       => 'License Type',
                'type'       => 7,
                'order'      => 5,
                'required'   => 0,
                'public'     => 0,
                'encrypted'  => 0,
                'purge'      => 0,
                'locked'     => 0,
                'created_at' => time(),
                'updated_at' => time()
            ]
        ]);

        DB::table('ticket_customfield_option')->insert([
            [
                'field_id'   => 1,
                'value'      => '2.0.0',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'field_id'   => 1,
                'value'      => '2.0.1',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'field_id'   => 1,
                'value'      => '2.0.2',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'field_id'   => 5,
                'value'      => 'Monthly',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'field_id'   => 5,
                'value'      => 'Owned',
                'created_at' => time(),
                'updated_at' => time()
            ]
        ]);

        // Assign custom fields to brands.
        DB::table('ticket_customfield_brand_membership')->insert([
            [ 'field_id' => 1, 'brand_id' => 1 ],
            [ 'field_id' => 2, 'brand_id' => 1 ],
            [ 'field_id' => 3, 'brand_id' => 1 ],
            [ 'field_id' => 4, 'brand_id' => 1 ],
            [ 'field_id' => 5, 'brand_id' => 1 ],
        ]);

        // Assign custom fields to departments
        DB::table('department_customfield_membership')->insert([
            [ 'field_id' => 1, 'department_id' => 1 ],
            [ 'field_id' => 1, 'department_id' => 4 ],
            [ 'field_id' => 2, 'department_id' => 1 ],
            [ 'field_id' => 2, 'department_id' => 4 ],
            [ 'field_id' => 3, 'department_id' => 1 ],
            [ 'field_id' => 3, 'department_id' => 4 ],
            [ 'field_id' => 4, 'department_id' => 1 ],
            [ 'field_id' => 4, 'department_id' => 4 ],
            [ 'field_id' => 5, 'department_id' => 2 ],
        ]);
        
        // Add to activity log
        DB::table('activity_log')->insert([
            [
                'type'          => 1,
                'rel_name'      => 'Installed Version',
                'rel_id'        => 1,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'Installation URL',
                'rel_id'        => 2,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'FTP Username',
                'rel_id'        => 3,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'FTP Password',
                'rel_id'        => 4,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'License Type',
                'rel_id'        => 5,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
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
