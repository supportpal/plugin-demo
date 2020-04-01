<?php
/**
 * File TypeSeeder.php
 */
namespace App\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\Brand;
use App\Modules\Selfservice\Controllers\Operator\DefaultTypeIcons;
use DB;

/**
 * Class TypeSeeder
 *
 * @package    App\Plugins\Demo\Seeds\SelfService
 */
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = 'Documentation';

        DB::table('article_type')->insert([
            [
                'brand_id'          => Brand::where('name', 'LIKE', 'Brand Demo')->first()->id,
                'name'              => $name,
                'slug'              => getSlug($name),
                'description'       => 'View our manual on setting up and using our software.',
                'enabled'           => 1,
                'view'              => 1,
                'icon'              => file_get_contents(base_path(DefaultTypeIcons::getIcon(1)['location'])),
                'show_on_dashboard' => 0,
                'created_at'        => time(),
                'updated_at'        => time()
            ]
        ]);
    }
}
