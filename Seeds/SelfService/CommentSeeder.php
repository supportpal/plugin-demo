<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment')->insert([
            [
                'article_id'    => 6,
                'type_id'       => 1,
                'author_id'     => 3,
                'text'          => $text = 'Looking forward to it!',
                'purified_text' => $text,
                'parent_id'     => null,
                'root_parent_id'=> null,
                'rating'        => 1,
                'status'        => 1,
                'notify_reply'  => 0,
                'created_at'    => time(),
                'updated_at'    => time()
            ],
            [
                'article_id'    => 6,
                'type_id'       => 1,
                'author_id'     => 1,
                'text'          => $text = '<a href=\'#comment-1\'>@PatrickMason</a> Thanks for your support!',
                'purified_text' => $text,
                'parent_id'     => 1,
                'root_parent_id'=> 1,
                'rating'        => 0,
                'status'        => 1,
                'notify_reply'  => 0,
                'created_at'    => time(),
                'updated_at'    => time()
            ]
        ]);

        DB::table('activity_log')->insert([
            [
                'type'      => 2,
                'rel_name'  => 'comment',
                'rel_id'    => 1,
                'rel_route' => 'selfservice.operator.comment.edit',
                'section'   => 'selfservice.comment',
                'user_id'   => 3,
                'user_name' => 'Patrick Mason',
                'event_name'=> 'selfservice_comment_posted',
                'ip'        => inet_pton('29.123.32.94'),
                'created_at'=> time(),
                'updated_at'=> time()
            ],
            [
                'type'      => 1,
                'rel_name'  => 2,
                'rel_id'    => 2,
                'rel_route' => 'selfservice.operator.comment.edit',
                'section'   => 'selfservice.comment',
                'user_id'   => 1,
                'user_name' => 'John Doe',
                'event_name'=> 'item_created',
                'ip'        => inet_pton('81.8.12.192'),
                'created_at'=> time(),
                'updated_at'=> time()
            ]
        ]);
    }
}
