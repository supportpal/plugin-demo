<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\Core\Models\Brand;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;

use function inet_pton;
use function now;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = now()->getTimestamp();

        $organisations = [
            [
                'brand_id'      => Brand::where('name', 'SupportPal')->firstOrFail()->id,
                'name'          => 'ACME Corp.',
                'country'       => 'GB',
                'language_code' => 'en',
                'timezone'      => 'Europe/London',
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
            [
                'brand_id'      => Brand::where('name', 'Brand Demo')->firstOrFail()->id,
                'name'          => 'Echo XYZ LLC',
                'country'       => 'US',
                'language_code' => 'en',
                'timezone'      => 'America/New_York',
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
        ];

        $operator = User::operator()->firstOrFail();

        $activityLogData = [];
        foreach ($organisations as $organisation) {
            $organisationId = DB::table('user_organisation')->insertGetId($organisation);
            $activityLogData[] = [
                'type'          => Type::Operator->value,
                'rel_name'      => $organisation['name'],
                'rel_id'        => $organisationId,
                'rel_route'     => 'user.operator.organisation.edit',
                'section'       => 'user.organisation',
                'user_id'       => $operator->id,
                'user_name'     => $operator->formatted_name,
                'event_name'    => 'item_created',
                'ip'            => inet_pton('81.8.12.192'),
                'created_at'    => $time,
                'updated_at'    => $time,
            ];
        }

        DB::table('activity_log')->insert($activityLogData);
    }
}
