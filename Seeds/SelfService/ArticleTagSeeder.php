<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

class ArticleTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        DB::table('article_tag')->insert([
            [
                'name'      => 'How To',
                'slug'      => 'how-to',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'name'       => 'Code Samples',
                'slug'       => 'code-samples',
                'created_at' => $time,
                'updated_at' => $time
            ],
            [
                'name'       => 'Release',
                'slug'       => 'release',
                'created_at' => $time,
                'updated_at' => $time
            ]
        ]);

        // Activity Log
        $this->activityLog([
            [ 'rel_id' => 1, 'rel_name' => 'How To' ],
            [ 'rel_id' => 2, 'rel_name' => 'Code Samples' ],
            [ 'rel_id' => 3, 'rel_name' => 'Release' ],
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
            'rel_route'     => 'selfservice.operator.tag.edit',
            'section'       => 'selfservice.tag',
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
