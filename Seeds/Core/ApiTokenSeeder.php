<?php
/**
 * File ApiTokenSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class ApiTokenSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Core
 */
class ApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        DB::table('apitoken')->insert([
            [
                'name'       => 'WHMCS Integration',
                'token'      => 'HO7OQn=sBd2nbBI3y9IYMOYalW7Po3vq',
                'access'     => 1,
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'name'       => 'Ticket Monitor',
                'token'      => 'Wwwx!biOyel%SYnfFie8qay88O1gS=4b',
                'access'     => 0,
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);
    }
}
