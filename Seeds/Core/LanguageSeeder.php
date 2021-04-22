<?php
/**
 * File LanguageSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class LanguageSeeder
 *
 * @package App\Plugins\Demo\Seeds\Core
 */
class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('language')->where('name', 'Spanish')
            ->update(['enabled' => 1]);
    }
}
