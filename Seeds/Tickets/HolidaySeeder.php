<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schedule_holiday')->insert([
            [
                'name'       => 'Christmas Day',
                'day'        => 25,
                'month'      => 12,
                'created_at' => time(),
                'updated_at' => time()
            ],
            [
                'name'       => 'New Years Day',
                'day'        => 1,
                'month'      => 1,
                'created_at' => time(),
                'updated_at' => time()
            ],
        ]);

        // Add to activity log
        DB::table('activity_log')->insert([
            [
                'type'          => 1,
                'rel_name'      => 'Christmas Day',
                'rel_id'        => 1,
                'rel_route'     => 'ticket.operator.holiday.edit',
                'section'       => 'ticket.holiday',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'type'          => 1,
                'rel_name'      => 'New Years Day',
                'rel_id'        => 2,
                'rel_route'     => 'ticket.operator.holiday.edit',
                'section'       => 'ticket.holiday',
                'user_id'       => 1,
                'user_name'     => 'John Doe',
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time()
            ],
        ]);
    }
}
