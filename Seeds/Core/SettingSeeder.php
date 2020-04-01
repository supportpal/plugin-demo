<?php
/**
 * File SettingSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class SettingSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Core
 */
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        $attributes = [
            'module_id'  => 1,
            'name'       => 'enable_ssl',
        ];
        DB::table('setting')->updateOrInsert($attributes, [
            'value'      => 1,
            'created_at' => $time,
            'updated_at' => $time
        ]);
    }
}
