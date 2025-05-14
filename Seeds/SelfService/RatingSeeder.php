<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\Brand;
use App\Modules\Selfservice\Models\Article;
use App\Modules\User\Models\User;
use DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandId = Brand::where('name', 'SupportPal')->firstOrFail()->id;
        $article = Article::where('slug', 'welcome-to-the-supportpal-demo')->firstOrFail();
        $user = User::where('email', 'user@demo.com')->where('brand_id', $brandId)->firstOrFail();

        DB::table('article_feedback_log')->insert([
            [
                'article_id' => $article->id,
                'user_id'    => $user->id,
                'user_ip'    => '29.123.32.94',
                'rating'     => 1,
                'created_at' => time(),
                'updated_at' => time()
            ]
        ]);

        DB::table('activity_log')->insert([
            [
                'type'      => 2,
                'rel_name'  => $article->title,
                'rel_id'    => $article->id,
                'rel_route' => 'selfservice.operator.article.edit',
                'section'   => 'selfservice.article',
                'user_id'   => $user->id,
                'user_name' => $user->formatted_name,
                'event_name'=> 'selfservice_article_upvoted',
                'ip'        => inet_pton('29.123.32.94'),
                'created_at'=> time(),
                'updated_at'=> time()
            ],
        ]);
    }
}
