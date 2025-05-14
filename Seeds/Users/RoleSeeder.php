<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use Illuminate\Support\Facades\DB;

use function now;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $id = DB::table('role')->insertGetId([
            'name'        => 'Support Operator',
            'slug'        => 'administrator',
            'description' => 'Limited permissions',
            'created_at'  => now()->getTimestamp(),
            'updated_at'  => now()->getTimestamp(),
        ]);

        // Limited permissions
        $permissions = [16, 18, 19, 20, 41, 42, 43, 48, 49, 50, 52];

        // Add relationship for all permissions
        foreach ($permissions as $permission) {
            DB::table('permission_role')->insert([
                'permission_id' => $permission,
                'role_id'       => $id
            ]);
        }
    }
}
