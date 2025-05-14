<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use Illuminate\Support\Facades\DB;

use function now;

class SpamRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = now()->getTimestamp();

        DB::table('spam_rule')->insert([
            [
                'text'          => 'Improve your SEO',
                'event_message' => 1,
                'event_comment' => 0,
                'type'          => 0,
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'text'          => 'improveseo@seospammers.com',
                'event_message' => 1,
                'event_comment' => 0,
                'type'          => 1,
                'created_at'    => $time,
                'updated_at'    => $time
            ],
            [
                'text'          => 'Cheap medicine',
                'event_message' => 1,
                'event_comment' => 1,
                'type'          => 2,
                'created_at'    => $time,
                'updated_at'    => $time
            ]
        ]);
    }
}
