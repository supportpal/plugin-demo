<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

class TicketTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_tag')->insert([
            [
                'name'       => 'Feature Request',
                'colour'     => '#e67e22',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'name'       => 'Bug',
                'colour'     => '#c0392b',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'name'       => 'Custom Work',
                'colour'     => '#16a085',
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'name'       => 'Logged',
                'colour'     => '#95a5a6',
                'created_at' => time(),
                'updated_at' => time()
            ],
        ]);

        // Activity Log
        $this->activityLog([
            [ 'rel_id' => 1, 'rel_name' => 'Feature Request' ],
            [ 'rel_id' => 2, 'rel_name' => 'Bug' ],
            [ 'rel_id' => 3, 'rel_name' => 'Custom Work' ],
            [ 'rel_id' => 4, 'rel_name' => 'Logged' ],
        ]);
    }

    /**
     * Add activity log entries.
     *
     * @param  array $data [ [ 'rel_name' => '', 'rel_id' => '' ], [ .. ] ]
     * @return void
     */
    private function activityLog(array $data)
    {
        $default = [
            'type'          => 1,
            'rel_route'     => 'ticket.operator.tag.edit',
            'section'       => 'ticket.tag',
            'user_id'       => 1,
            'user_name'     => 'John Doe',
            'event_name'    => 'item_created',
            'ip'            => inet_pton('81.8.12.192'),
            'created_at'    => time(),
            'updated_at'    => time()
        ];

        foreach ($data as $k => $row) {
            $data[$k] = $row + $default;
        }

        DB::table('activity_log')->insert($data);
    }
}
