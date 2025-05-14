<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use Illuminate\Support\Facades\DB;

use function now;

class ApiTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = now()->getTimestamp();

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
