<?php
/**
 * File RoleSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class RoleSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Users
 */
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('role')->insertGetId([
            'name'        => 'Support Operator',
            'slug'        => 'administrator',
            'description' => 'Limited permissions',
            'created_at'  => time(),
            'updated_at'  => time(),
        ]);

        // Limited permissions
        $permissions = [ 16, 18, 19, 20, 41, 42, 43, 48, 49, 50, 52 ];

        // Add relationship for all permissions
        foreach ($permissions as $permission) {
            DB::table('permission_role')->insert([
                'permission_id' => $permission,
                'role_id'       => $id
            ]);
        }
    }
}
