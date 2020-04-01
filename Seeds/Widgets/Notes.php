<?php
/**
 * File Notes.php
 */
namespace App\Plugins\Demo\Seeds\Widgets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\User\Models\OperatorSetting;

/**
 * Class Notes
 *
 * @package    App\Plugins\Demo\Seeds\Widgets
 */
class Notes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OperatorSetting::where('id', 1)
            ->update([ 'widget_notes' => 'Thank you for choosing SupportPal.' ]);
    }
}
