<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Middleware;

use Closure;
use Illuminate\Http\Request;

use function session;

class GeneralSettings
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Prevent enabling debug mode.
        $request->merge(['debug_mode' => 0]);

        session()->flash('error', 'It is not possible to enable debug mode in the demo.');

        return $next($request);
    }
}
