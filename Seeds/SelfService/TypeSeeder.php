<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\Brand;
use App\Modules\Selfservice\Controllers\Operator\DefaultTypeIcons;
use DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_type')->insert([
            [
                'brand_id'          => Brand::where('name', 'LIKE', 'Brand Demo')->first()->id,
                'name'              => $name = 'Documentation',
                'slug'              => getSlug($name),
                'description'       => 'View our manual on setting up and using our software.',
                'enabled'           => 1,
                'view'              => 1,
                'icon'              => 'fa-book',
                'show_on_dashboard' => 0,
                'created_at'        => time(),
                'updated_at'        => time()
            ]
        ]);
    }
}
