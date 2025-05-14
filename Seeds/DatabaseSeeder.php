<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds;

use Addons\Plugins\Demo\Controllers\Demo;
use Addons\Plugins\Demo\Seeds\Core\ApiTokenSeeder;
use Addons\Plugins\Demo\Seeds\Core\BrandSeeder;
use Addons\Plugins\Demo\Seeds\Core\EmailTemplateSeeder;
use Addons\Plugins\Demo\Seeds\Core\IpBanSeeder;
use Addons\Plugins\Demo\Seeds\Core\IpWhitelistSeeder;
use Addons\Plugins\Demo\Seeds\Core\LanguageSeeder;
use Addons\Plugins\Demo\Seeds\Core\SpamRuleSeeder;
use Addons\Plugins\Demo\Seeds\Plugins\LoginSeeder;
use Addons\Plugins\Demo\Seeds\SelfService\ArticleSeeder;
use Addons\Plugins\Demo\Seeds\SelfService\CategorySeeder;
use Addons\Plugins\Demo\Seeds\SelfService\CommentSeeder;
use Addons\Plugins\Demo\Seeds\SelfService\RatingSeeder;
use Addons\Plugins\Demo\Seeds\SelfService\ArticleTagSeeder;
use Addons\Plugins\Demo\Seeds\SelfService\TypeSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\CannedResponseSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\DepartmentSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\DepartmentEmailSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\FeedbackSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\FilterSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\HolidaySeeder;
use Addons\Plugins\Demo\Seeds\Tickets\MacroSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\SlaPlanSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\TicketCustomFieldSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\TicketSeeder;
use Addons\Plugins\Demo\Seeds\Tickets\TicketTagSeeder;
use Addons\Plugins\Demo\Seeds\Users\CustomFieldSeeder;
use Addons\Plugins\Demo\Seeds\Users\GroupSeeder;
use Addons\Plugins\Demo\Seeds\Users\OperatorSeeder;
use Addons\Plugins\Demo\Seeds\Users\OrganisationSeeder;
use Addons\Plugins\Demo\Seeds\Users\RoleSeeder;
use Addons\Plugins\Demo\Seeds\Users\UserSeeder;
use Addons\Plugins\Demo\Seeds\Widgets\Notes;
use Addons\Plugins\Demo\Seeds\Widgets\Todo;
use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\User\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        // Seed core content.
        $this->call(BrandSeeder::class);
        $this->call(EmailTemplateSeeder::class);
        $this->call(ApiTokenSeeder::class);
        $this->call(IpBanSeeder::class);
        $this->call(IpWhitelistSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(SpamRuleSeeder::class);

        // Seed operator widgets.
        $this->call(Todo::class);
        $this->call(Notes::class);

        // Seed plugins.
        $this->call(LoginSeeder::class);

        // Seed users & organisations.
        $this->call(RoleSeeder::class);
        $this->call(GroupSeeder::class);
        $this->call(OperatorSeeder::class);
        $this->call(CustomFieldSeeder::class);
        $this->call(OrganisationSeeder::class);
        $this->call(UserSeeder::class);

        // Seed self-service content.
        $this->call(TypeSeeder::class);
        $this->call(ArticleTagSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(RatingSeeder::class);
        $this->call(CommentSeeder::class);

        // Seed ticket content.
        $this->call(DepartmentSeeder::class);
        $this->call(DepartmentEmailSeeder::class);
        $this->call(TicketCustomFieldSeeder::class);
        $this->call(TicketTagSeeder::class);
        $this->call(SlaPlanSeeder::class);
        $this->call(MacroSeeder::class);
        $this->call(FilterSeeder::class);
        $this->call(TicketSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(CannedResponseSeeder::class);
        $this->call(HolidaySeeder::class);

        // Delete the PHP Information and License Information permissions so that the pages cannot be viewed.
        Permission::where('name', 'phpinfo')->delete();
        Permission::where('name', 'license')->delete();
        Permission::where('name', 'logfiles')->delete();
        $plugin = DB::table('plugin')->where('name', Demo::IDENTIFIER)->first();
        DB::table('plugin_role')->where('plugin_id', $plugin->id)->delete();

        // Allows the cron to run but prevents some tasks from running.
        DB::table('scheduled_task')
            ->whereIn('class', [
                'App\Modules\Core\Models\EmailQueue',
                'App\Modules\Core\Controllers\Update\Manager\UpdateManager'
            ])
            ->delete();

        Model::reguard();
    }
}
