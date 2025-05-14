<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\Brand;
use App\Modules\Core\Models\CustomField;
use App\Modules\Ticket\Models\Department;
use App\Modules\User\Models\User;
use DB;

class TicketCustomFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $field1 = DB::table('ticket_customfield')->insertGetId([
            'name'       => 'Installed Version',
            'type'       => CustomField::OPTIONS,
            'order'      => 1,
            'required'   => 1,
            'public'     => 1,
            'encrypted'  => 0,
            'purge'      => 0,
            'locked'     => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $field2 = DB::table('ticket_customfield')->insertGetId([
            'name'       => 'Installation URL',
            'type'       => CustomField::TEXT,
            'order'      => 2,
            'required'   => 1,
            'public'     => 1,
            'encrypted'  => 0,
            'purge'      => 0,
            'locked'     => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $field3 = DB::table('ticket_customfield')->insertGetId([
            'name'       => 'FTP Username',
            'type'       => CustomField::TEXT,
            'order'      => 3,
            'required'   => 0,
            'public'     => 1,
            'encrypted'  => 1,
            'purge'      => 1,
            'locked'     => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $field4 = DB::table('ticket_customfield')->insertGetId([
            'name'       => 'FTP Password',
            'type'       => CustomField::PASSWORD,
            'order'      => 4,
            'required'   => 0,
            'public'     => 1,
            'encrypted'  => 1,
            'purge'      => 1,
            'locked'     => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        $field5 = DB::table('ticket_customfield')->insertGetId([
            'name'       => 'License Type',
            'type'       => CustomField::RADIO,
            'order'      => 5,
            'required'   => 0,
            'public'     => 0,
            'encrypted'  => 0,
            'purge'      => 0,
            'locked'     => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        DB::table('ticket_customfield_option')->insert([
            [
                'field_id'   => $field1,
                'value'      => '2.0.0',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'field_id'   => $field1,
                'value'      => '2.0.1',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'field_id'   => $field1,
                'value'      => '2.0.2',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'field_id'   => $field5,
                'value'      => 'Monthly',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'field_id'   => $field5,
                'value'      => 'Owned',
                'created_at' => time(),
                'updated_at' => time()
            ]
        ]);

        // Assign custom fields to brands.
        $brand = Brand::where('name', 'SupportPal')->firstOrFail();
        DB::table('ticket_customfield_brand_membership')->insert([
            [ 'field_id' => $field1, 'brand_id' => $brand->id ],
            [ 'field_id' => $field2, 'brand_id' => $brand->id ],
            [ 'field_id' => $field3, 'brand_id' => $brand->id ],
            [ 'field_id' => $field4, 'brand_id' => $brand->id ],
            [ 'field_id' => $field5, 'brand_id' => $brand->id ],
        ]);

        // Assign custom fields to departments
        $support = Department::where('name', 'Support')->firstOrFail();
        $sales = Department::where('name', 'Sales')->firstOrFail();
        $bugs = Department::where('name', 'Bugs')->firstOrFail();
        DB::table('department_customfield_membership')->insert([
            [ 'field_id' => $field1, 'department_id' => $support->id ],
            [ 'field_id' => $field1, 'department_id' => $bugs->id ],
            [ 'field_id' => $field2, 'department_id' => $support->id ],
            [ 'field_id' => $field2, 'department_id' => $bugs->id ],
            [ 'field_id' => $field3, 'department_id' => $support->id ],
            [ 'field_id' => $field3, 'department_id' => $bugs->id ],
            [ 'field_id' => $field4, 'department_id' => $support->id ],
            [ 'field_id' => $field4, 'department_id' => $bugs->id ],
            [ 'field_id' => $field5, 'department_id' => $sales->id ],
        ]);
        
        // Add to activity log
        $operator = User::operator()->firstOrFail();
        DB::table('activity_log')->insert([
            [
                'type'          => 1,
                'rel_name'      => 'Installed Version',
                'rel_id'        => $field1,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
                'user_id'       => $operator->id,
                'user_name'     => $operator->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'Installation URL',
                'rel_id'        => $field2,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
                'user_id'       => $operator->id,
                'user_name'     => $operator->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'FTP Username',
                'rel_id'        => $field3,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
                'user_id'       => $operator->id,
                'user_name'     => $operator->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'FTP Password',
                'rel_id'        => $field4,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
                'user_id'       => $operator->id,
                'user_name'     => $operator->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'License Type',
                'rel_id'        => $field5,
                'rel_route'     => 'ticket.operator.customfield.edit',
                'section'       => 'ticket.customfield',
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
