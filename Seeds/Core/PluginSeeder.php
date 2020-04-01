<?php
/**
 * File PluginSeeder.php
 */
namespace App\Plugins\Demo\Seeds\Core;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Plugins\Demo\Controllers\Demo;
use Exception;
use PluginFactory;

/**
 * Class PluginSeeder
 *
 * @package App\Plugins\Demo\Seeds\Core
 */
class PluginSeeder extends Seeder
{
    /**
     * Enable the plugin.
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
