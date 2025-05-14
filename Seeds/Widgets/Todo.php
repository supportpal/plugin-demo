<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Seeds\Widgets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use App\Modules\User\Models\User;
use Illuminate\Support\Facades\DB;

use function now;

class Todo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('operator_todo_widget')->insert([
            [
                'user_id'       => User::operator()->firstOrFail()->id,
                'text'          => 'Make sure to complete new feature request #323',
                'due'           => now()->addDay()->getTimestamp(),
                'created_at'    => now()->getTimestamp(),
                'updated_at'    => now()->getTimestamp()
            ]
        ]);
    }
}
