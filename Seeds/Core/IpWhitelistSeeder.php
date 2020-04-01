<?php
/**
 * File IpWhitelistSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class IpWhitelistSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Core
 */
class IpWhitelistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ip_whitelist')->insert([
            'ip'             => inet_pton('192.168.0.25'),
            'description'    => 'VM used for ticket monitor.',
            'event_user'     => 0,
            'event_operator' => 0,
            'event_api'      => 1,
            'created_at'     => time(),
            'updated_at'     => time()
        ]);
    }
}
