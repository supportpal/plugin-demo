<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('language')
            ->where('name', 'Spanish')
            ->update(['enabled' => 1]);
    }
}
