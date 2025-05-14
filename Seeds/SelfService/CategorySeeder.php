<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;

use function inet_pton;
use function now;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $time = now()->getTimestamp();

        $categories = [
            [
                'type_id'       => 1, // Announcements
                'parent_id'     => null,
                'name'          => 'Press Releases',
                'slug'          => 'press-releases',
                'public'        => 1,
                'parent_public' => 1,
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
            [
                'type_id'       => 1, // Announcements
                'parent_id'     => null,
                'name'          => 'General',
                'slug'          => 'general',
                'public'        => 1,
                'parent_public' => 1,
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
            [
                'type_id'       => 2, // Knowledgebase
                'parent_id'     => null,
                'name'          => 'Getting Started',
                'slug'          => 'getting-started',
                'public'        => 1,
                'parent_public' => 1,
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
            [
                'type_id'       => 2, // Knowledgebase
                'parent_id'     => null,
                'name'          => 'Customisation',
                'slug'          => 'customisation',
                'public'        => 1,
                'parent_public' => 1,
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
            [
                'type_id'       => 2, // Knowledgebase
                'parent_id'     => null,
                'name'          => 'API',
                'slug'          => 'api',
                'public'        => 1,
                'parent_public' => 1,
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
            [
                'type_id'       => 2, // Knowledgebase
                'parent_id'     => null,
                'name'          => 'Plugins',
                'slug'          => 'plugins',
                'public'        => 0,
                'parent_public' => 1,
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
            [
                'type_id'       => 3, // Documentation
                'parent_id'     => null,
                'name'          => 'Installation',
                'slug'          => 'installation',
                'public'        => 1,
                'parent_public' => 1,
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
            [
                'type_id'       => 3, // Documentation
                'parent_id'     => null,
                'name'          => 'Release Notes',
                'slug'          => 'release-notes',
                'public'        => 1,
                'parent_public' => 1,
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
        ];

        $activityLogData = [];
        foreach ($categories as $category) {
            $id = DB::table('article_category')->insertGetId($category);
            $activityLogData[] = [
                'rel_id'   => $id,
                'rel_name' => $category['name'],
            ];
        }

        $this->activityLog($activityLogData);
    }

    /**
     * Add activity log entries.
     *
     * @param mixed[] $data [ [ 'rel_name' => '', 'rel_id' => '' ], [ .. ] ]
     */
    private function activityLog(array $data): void
    {
        $operator = User::operator()->firstOrFail();

        $default = [
            'type'          => Type::Operator->value,
            'rel_route'     => 'selfservice.operator.category.edit',
            'section'       => 'general.category',
            'user_id'       => $operator->id,
            'user_name'     => $operator->formatted_name,
            'event_name'    => 'item_created',
            'ip'            => inet_pton('81.8.12.192'),
            'created_at'    => now()->getTimestamp(),
            'updated_at'    => now()->getTimestamp(),
        ];

        foreach ($data as $k => $row) {
            $data[$k] = $row + $default;
        }

        DB::table('activity_log')->insert($data);
    }
}
