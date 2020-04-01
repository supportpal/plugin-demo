<?php
/**
 * File IpBanSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class IpBanSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Core
 */
class IpBanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ip_ban')->insert([
            'ip'             => inet_pton('12.34.56.78'),
            'reason'         => 'Attempting to log in to other users\' accounts',
            'event_user'     => 1,
            'event_operator' => 0,
            'event_api'      => 0,
            'type'           => 1,
            'expiry'         => null,
            'created_at'     => time(),
            'updated_at'     => time()
        ]);
    }
}
