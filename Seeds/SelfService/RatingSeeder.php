<?php
/**
 * File RatingSeeder.php
 */
namespace App\Plugins\Demo\Seeds\SelfService;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class RatingSeeder
 *
 * @package    App\Plugins\Demo\Seeds\SelfService
 */
class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('article_feedback_log')->insert([
            [
                'article_id' => 6,
                'user_id'    => 2,
                'user_ip'    => '29.123.32.94',
                'rating'     => 1,
                'created_at' => time(),
                'updated_at' => time()
            ]
        ]);

        DB::table('activity_log')->insert([
            [
                'type'      => 2,
                'rel_name'  => 'Welcome to the SupportPal Demo',
                'rel_id'    => 6,
                'rel_route' => 'selfservice.operator.article.edit',
                'section'   => 'selfservice.article',
                'user_id'   => 3,
                'user_name' => 'Patrick Mason',
                'event_name'=> 'selfservice_article_upvoted',
                'ip'        => inet_pton('29.123.32.94'),
                'created_at'=> time(),
                'updated_at'=> time()
            ],
        ]);
    }
}
