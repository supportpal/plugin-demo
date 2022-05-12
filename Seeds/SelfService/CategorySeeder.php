<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        DB::table('article_category')->insert([
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
                'parent_id'     => 4,
                'name'          => 'API',
                'slug'          => 'api',
                'public'        => 1,
                'parent_public' => 1,
                'created_at'    => $time,
                'updated_at'    => $time,
            ],
            [
                'type_id'       => 2, // Knowledgebase
                'parent_id'     => 4,
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
            ]
        ]);

        // Activity Log
        $this->activityLog([
            [ 'rel_id' => 1, 'rel_name' => 'Press Releases' ],
            [ 'rel_id' => 2, 'rel_name' => 'General' ],
            [ 'rel_id' => 3, 'rel_name' => 'Getting Started' ],
            [ 'rel_id' => 4, 'rel_name' => 'Customisation' ],
            [ 'rel_id' => 5, 'rel_name' => 'API' ],
            [ 'rel_id' => 6, 'rel_name' => 'Plugins' ],
            [ 'rel_id' => 7, 'rel_name' => 'Installation' ],
            [ 'rel_id' => 8, 'rel_name' => 'Release Notes' ],
        ]);
    }

    /**
     * Add activity log entries.
     *
     * @param  array $data [ [ 'rel_name' => '', 'rel_id' => '' ], [ .. ] ]
     * @return void
     */
    private function activityLog(array $data)
    {
        $default = [
            'type'          => 1,
            'rel_route'     => 'selfservice.operator.category.edit',
            'section'       => 'general.category',
            'user_id'       => 1,
            'user_name'     => 'John Doe',
            'event_name'    => 'item_created',
            'ip'            => inet_pton('81.8.12.192'),
            'created_at'    => time(),
            'updated_at'    => time()
        ];

        foreach ($data as $k => $row) {
            $data[$k] = $row + $default;
        }

        DB::table('activity_log')->insert($data);
    }
}
