<?php
/**
 * File GeneralSettings.php
 */
namespace App\Plugins\Demo\Middleware;

use Closure;

/**
 * Class GeneralSettings
 *
 * @package    App\Plugins\Demo\Controllers
 */
class GeneralSettings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Prevent enabling debug mode.
        $request->merge(['debug_mode' => 0]);

        session()->flash('error', 'It is not possible to enable debug mode in the demo.');

        return $next($request);
    }
}
