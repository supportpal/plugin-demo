<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Core;

use Addons\Plugins\Demo\Controllers\Demo;
use App\Modules\Core\Controllers\Database\Seed\Seeder;
use Exception;
use PluginFactory;

class PluginSeeder extends Seeder
{
    /**
     * Enable the plugin.
     */
    public function run(): void
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
