<?php
/**
 * File CustomFieldSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Users;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class CustomFieldSeeder
 *
 * @package    App\Plugins\Demo\Seeds\Users
 */
class CustomFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_customfield')->insert([
            [
                'name'      => 'Address 1',
                'type'      => 8, // Text
                'order'     => 1,
                'created_at'=> time(),
                'updated_at'=> time(),
            ],
            [
                'name'      => 'Address 2',
                'type'      => 8, // Text
                'order'     => 2,
                'created_at'=> time(),
                'updated_at'=> time(),
            ],
            [
                'name'      => 'Postal Code',
                'type'      => 8, // Text
                'order'     => 1,
                'created_at'=> time(),
                'updated_at'=> time(),
            ],
            [
                'name'      => 'How did you find us?',
                'type'      => 8, // Text
                'order'     => 1,
                'created_at'=> time(),
                'updated_at'=> time(),
            ],
        ]);

        // Assign custom fields to brands.
        DB::table('user_customfield_brand_membership')->insert([
            [ 'field_id' => 1, 'brand_id' => 1 ],
            [ 'field_id' => 2, 'brand_id' => 1 ],
            [ 'field_id' => 3, 'brand_id' => 1 ],
            [ 'field_id' => 4, 'brand_id' => 1 ],
        ]);

        $this->activityLog([
            ['rel_id' => 1, 'rel_name' => 'Address 1'],
            ['rel_id' => 2, 'rel_name' => 'Address 2'],
            ['rel_id' => 3, 'rel_name' => 'Postal Code'],
            ['rel_id' => 4, 'rel_name' => 'How did you find us?'],
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
            'rel_route'     => 'user.operator.customfield.edit',
            'section'       => 'user.customfield',
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
