<?php
/**
 * File Todo.php
 */
namespace App\Plugins\Demo\Seeds\Widgets;

use App\Modules\Core\Controllers\Database\Seed\Seeder;
use DB;

/**
 * Class Todo
 *
 * @package    App\Plugins\Demo\Seeds\Widgets
 */
class Todo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operator_todo_widget')->insert([
            [
                'user_id'       => 1,
                'text'          => 'Make sure to complete new feature request #323',
                'due'           => time() + 86400, // Tomorrow
                'created_at'    => time(),
                'updated_at'    => time()
            ]
        ]);
    }
}
