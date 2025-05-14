<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\Brand;
use App\Modules\Selfservice\Models\Article;
use App\Modules\Selfservice\Models\Type;
use App\Modules\User\Models\User;
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
        $announcements = Type::where('slug', 'announcements')->firstOrFail();
        $article = Article::where('slug', 'welcome-to-the-supportpal-demo')->firstOrFail();

        $brandId = Brand::where('name', 'SupportPal')->firstOrFail()->id;
        $user = User::where('email', 'user@demo.com')->where('brand_id', $brandId)->firstOrFail();

        $comment1 = DB::table('comment')->insertGetId([
            'article_id'    => $article->id,
            'type_id'       => $announcements->id,
            'author_id'     => $user->id,
            'text'          => $text = 'Looking forward to it!',
            'purified_text' => $text,
            'parent_id'     => null,
            'root_parent_id'=> null,
            'rating'        => 1,
            'status'        => 1,
            'notify_reply'  => 0,
            'created_at'    => time(),
            'updated_at'    => time()
        ]);

        $operator = User::operator()->firstOrFail();
        $comment2 = DB::table('comment')->insertGetId([
            'article_id'    => $article->id,
            'type_id'       => $announcements->id,
            'author_id'     => $operator->id,
            'text'          => $text = '<a href=\'#comment-1\'>@PatrickMason</a> Thanks for your support!',
            'purified_text' => $text,
            'parent_id'     => 1,
            'root_parent_id'=> 1,
            'rating'        => 0,
            'status'        => 1,
            'notify_reply'  => 0,
            'created_at'    => time(),
            'updated_at'    => time()
        ]);

        DB::table('activity_log')->insert([
            [
                'type'      => \App\Modules\Core\Models\ActivityLog\Type::User->value,
                'rel_name'  => 'selfservice.comment',
                'rel_id'    => $comment1,
                'rel_route' => 'selfservice.operator.comment.edit',
                'section'   => 'selfservice.comment',
                'user_id'   => $user->id,
                'user_name' => $user->formatted_name,
                'event_name'=> 'selfservice_comment_posted',
                'ip'        => inet_pton('29.123.32.94'),
                'created_at'=> time(),
                'updated_at'=> time()
            ],
            [
                'type'      => \App\Modules\Core\Models\ActivityLog\Type::Operator->value,
                'rel_name'  => 'selfservice.comment',
                'rel_id'    => $comment2,
                'rel_route' => 'selfservice.operator.comment.edit',
                'section'   => 'selfservice.comment',
                'user_id'   => $operator->id,
                'user_name' => $operator->formatted_name,
                'event_name'=> 'item_created',
                'ip'        => inet_pton('81.8.12.192'),
                'created_at'=> time(),
                'updated_at'=> time()
            ]
        ]);
    }
}
