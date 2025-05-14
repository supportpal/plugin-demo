<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Tickets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\ActivityLog\Type;
use App\Modules\User\Models\User;
use DB;

class CannedResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = time();

        $response1 = DB::table('canned_response')->insertGetId([
            'name'       => 'Patch',
            'text'       => $text = '<strong>Steps to apply the patch:</strong><ol><li>Take a backup of your existing installation files</li><li>Extract the attached zip and upload it to the root of your installation</li><li>Verify functionality is as intended otherwise revert to the backup from step 1 and report back.</li></ol>',
            'purified_text' => $text,
            'hash'       => 'jMdUUscGQB',
            'user_id'    => null,
            'all_groups' => 1,
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        $response2 = DB::table('canned_response')->insertGetId([
            'name'       => 'Replicated bug',
            'text'       => $text = 'Hi {{ user.firstname }},<br><br> Thanks for reporting this, We have managed to replicate the error and can confirm it as a bug.<br><br>We\'ll look into it and get it fixed for the next release.',
            'purified_text' => $text,
            'hash'       => 'yWRfwOKhAJ',
            'user_id'    => null,
            'all_groups' => 1,
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        $response3 = DB::table('canned_response')->insertGetId([
            'name'       => 'More details please',
            'text'       => $text = 'Hi {{ user.firstname }},<br><br> Thanks for contacting us. I would be happy to look in to this problem for you, would you be able to let me know the steps required to replicate the issue?',
            'purified_text' => $text,
            'hash'       => 'AOSBPKbqUl',
            'user_id'    => User::operator()->firstOrFail()->id,
            'all_groups' => 0,
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        // Activity Log
        $this->activityLog([
            [ 'rel_id' => $response1, 'rel_name' => 'Patch' ],
            [ 'rel_id' => $response2, 'rel_name' => 'Replicated bug' ],
            [ 'rel_id' => $response3, 'rel_name' => 'More details please' ],
        ]);

        $tag1 = DB::table('canned_response_tag')->insertGetId([
            'name'       => 'Support',
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        $tag2 = DB::table('canned_response_tag')->insertGetId([
            'name'       => 'Software',
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        DB::table('canned_response_tag_membership')->insert([
            [ 'response_id' => $response2, 'tag_id' => $tag1 ],
            [ 'response_id' => $response2, 'tag_id' => $tag2 ],
            [ 'response_id' => $response3, 'tag_id' => $tag1 ],
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
        $operator = User::operator()->firstOrFail();
        $default = [
            'type'          => Type::Operator->value,
            'rel_route'     => 'ticket.operator.cannedresponse.edit',
            'section'       => 'ticket.cannedresponse',
            'user_id'       => $operator->id,
            'user_name'     => $operator->formatted_name,
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
