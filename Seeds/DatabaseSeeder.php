<?php
/**
 * File DatabaseSeeder.php
 */
namespace App\Plugins\Demo\Seeds;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\User\Models\Permission;
use App\Plugins\Demo\Controllers\Demo;
use App\Plugins\Demo\Seeds\Core\ApiTokenSeeder;
use App\Plugins\Demo\Seeds\Core\BrandSeeder;
use App\Plugins\Demo\Seeds\Core\EmailTemplateSeeder;
use App\Plugins\Demo\Seeds\Core\IpBanSeeder;
use App\Plugins\Demo\Seeds\Core\IpWhitelistSeeder;
use App\Plugins\Demo\Seeds\Core\LanguageSeeder;
use App\Plugins\Demo\Seeds\Core\SettingSeeder;
use App\Plugins\Demo\Seeds\Core\SpamRuleSeeder;
use App\Plugins\Demo\Seeds\Plugins\LoginSeeder;
use App\Plugins\Demo\Seeds\SelfService\ArticleSeeder;
use App\Plugins\Demo\Seeds\SelfService\CategorySeeder;
use App\Plugins\Demo\Seeds\SelfService\CommentSeeder;
use App\Plugins\Demo\Seeds\SelfService\RatingSeeder;
use App\Plugins\Demo\Seeds\SelfService\ArticleTagSeeder;
use App\Plugins\Demo\Seeds\SelfService\TypeSeeder;
use App\Plugins\Demo\Seeds\Tickets\CannedResponseSeeder;
use App\Plugins\Demo\Seeds\Tickets\DepartmentSeeder;
use App\Plugins\Demo\Seeds\Tickets\DepartmentEmailSeeder;
use App\Plugins\Demo\Seeds\Tickets\FeedbackSeeder;
use App\Plugins\Demo\Seeds\Tickets\FilterSeeder;
use App\Plugins\Demo\Seeds\Tickets\HolidaySeeder;
use App\Plugins\Demo\Seeds\Tickets\MacroSeeder;
use App\Plugins\Demo\Seeds\Tickets\SlaPlanSeeder;
use App\Plugins\Demo\Seeds\Tickets\TicketCustomFieldSeeder;
use App\Plugins\Demo\Seeds\Tickets\TicketSeeder;
use App\Plugins\Demo\Seeds\Tickets\TicketTagSeeder;
use App\Plugins\Demo\Seeds\Users\CustomFieldSeeder;
use App\Plugins\Demo\Seeds\Users\GroupSeeder;
use App\Plugins\Demo\Seeds\Users\OperatorSeeder;
use App\Plugins\Demo\Seeds\Users\OrganisationSeeder;
use App\Plugins\Demo\Seeds\Users\RoleSeeder;
use App\Plugins\Demo\Seeds\Users\UserSeeder;
use App\Plugins\Demo\Seeds\Widgets\Notes;
use App\Plugins\Demo\Seeds\Widgets\Todo;
use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DatabaseSeeder
 *
 * @package    App\Plugins\Demo\Seeds
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Seed core content.
        $this->call(SettingSeeder::class);
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

        Model::reguard();
    }
}
