<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Widgets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\User\Models\OperatorSetting;
use App\Modules\User\Models\User;

class Notes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OperatorSetting::where('id', User::operator()->firstOrFail()->id)
            ->update(['widget_notes' => 'Thank you for choosing SupportPal.']);
    }
}
