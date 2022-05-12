<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\Core\Models\EmailTemplate;
use DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time= time();

        DB::table('email_template')->insert([
            'id'          => 100,
            'name'        => 'High demand',
            'description' => 'Apologises to user for delay due to increased workload.',
            'type'        => EmailTemplate::CUSTOM,
            'created_at'  => $time,
            'updated_at'  => $time,
        ]);

        DB::table('email_template_data')->insert([
            'template_id' => 100,
            'subject'     => 'Apologies for delay - experiencing high demand',
            'contents'    => 'Dear {{ user.formatted_name }},<br>
<br>
We are currently experiencing high demand and thus it is taking longer than normal to respond. We apologise for any delay you experience and appreciate your patience, we will get back to you as soon as we can.<br>
<br>
Kind Regards,<br>
<strong>{{ brand.name }}</strong>',
            'created_at'  => $time,
            'updated_at'  => $time
        ]);
    }
}
