<?php
/**
 * File LoginSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Plugins;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Plugins\Demo\Controllers\Demo;
use Exception;
use PluginFactory;

/**
 * Class LoginSeeder
 *
 * @package App\Plugins\Demo\Seeds\Plugins
 */
class LoginSeeder extends Seeder
{
    /**
     * Enable the Demo plugin by default.
     *
     * @return void
     */
    public function run()
    {
        PluginFactory::synchronise();

        $name = Demo::IDENTIFIER;
        $plugin = PluginFactory::getPlugin($name);

        try {
            // Reactivate the plugin (to force the upgrade).
            PluginFactory::activate($plugin, true);
        } catch (Exception $e) {
            $this->note("[ERROR]: Failed to activate '$name' plugin. Plugin has been "
                . "deactivated. Please activate again via Plugins in the operator panel.");
        }
    }
}
