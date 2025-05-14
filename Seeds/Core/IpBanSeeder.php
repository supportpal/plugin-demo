<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use Illuminate\Support\Facades\DB;

use function inet_pton;
use function now;

class IpBanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ip_ban')->insert([
            'ip'             => inet_pton('12.34.56.78'),
            'reason'         => 'Attempting to log in to other users\' accounts',
            'event_user'     => 1,
            'event_operator' => 0,
            'event_api'      => 0,
            'type'           => 1,
            'expiry'         => null,
            'created_at'     => now()->getTimestamp(),
            'updated_at'     => now()->getTimestamp()
        ]);
    }
}
