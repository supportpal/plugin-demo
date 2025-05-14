<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\User\Models\User;
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
        $holiday1 = DB::table('schedule_holiday')->insertGetId([
            'name'       => 'Christmas Day',
            'day'        => 25,
            'month'      => 12,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $holiday2 = DB::table('schedule_holiday')->insertGetId([
            'name'       => 'New Years Day',
            'day'        => 1,
            'month'      => 1,
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        // Add to activity log
        $operator = User::operator()->firstOrFail();
        DB::table('activity_log')->insert([
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'Christmas Day',
                'rel_id'        => $holiday1,
                'rel_route'     => 'ticket.operator.holiday.edit',
                'section'       => 'ticket.holiday',
                'user_id'       => $operator->id,
                'user_name'     => $operator->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time(),
            ],
            [
                'type'          => Type::Operator->value,
                'rel_name'      => 'New Years Day',
                'rel_id'        => $holiday2,
                'rel_route'     => 'ticket.operator.holiday.edit',
                'section'       => 'ticket.holiday',
                'user_id'       => $operator->id,
                'user_name'     => $operator->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => time(),
                'updated_at'    => time(),
            ],
        ]);
    }
}
