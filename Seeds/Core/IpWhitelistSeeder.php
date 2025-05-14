<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use Illuminate\Support\Facades\DB;

use function inet_pton;
use function now;

class IpWhitelistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ip_whitelist')->insert([
            'ip'             => inet_pton('192.168.0.25'),
            'description'    => 'VM used for ticket monitor.',
            'event_user'     => 0,
            'event_operator' => 0,
            'event_api'      => 1,
            'created_at'     => now()->getTimestamp(),
            'updated_at'     => now()->getTimestamp()
        ]);
    }
}
