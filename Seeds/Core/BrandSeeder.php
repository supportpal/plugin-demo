<?php
/**
 * File BrandSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class BrandSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Core
 */
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Add the brand.
        $id = DB::table('brand')->insertGetId([
            'name' => 'Brand Demo',
            'enabled' => 1,
            'system_url' => 'https://brand.demo.supportpal.com',
            'brand_colour' => '#E74C3C',
            'frontend_logo' => 'https://www.supportpal.com/assets/img/acmesoftware.png',
            'frontend_template'  => 'demo',
            'default_email' => 'brand-demo@demo.com',
            'global_email_header' => '',
            'global_email_footer' => '<hr /><strong>{{ brand.name }}</strong>',
            'language_toggle' => 0,
            'created_at' => time(),
            'updated_at' => time()
        ]);

        // Associate article with types.
        DB::table('brand_operator_group_membership')->insert([
            'brand_id' => $id,
            'group_id' => 1
        ]);

        DB::table('activity_log')->insert([
            'type'          => 1,
            'rel_id'        => $id,
            'rel_name'      => 'Brand Demo',
            'rel_route'     => 'core.operator.brand.edit',
            'section'       => 'core.brand',
            'user_id'       => 1,
            'user_name'     => 'John Doe',
            'event_name'    => 'item_created',
            'ip'            => inet_pton('81.8.12.192'),
            'created_at'    => time(),
            'updated_at'    => time()
        ]);
    }
}
