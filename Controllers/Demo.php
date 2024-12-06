<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Controllers;

use Addons\Plugins\Demo\Events\Observers\UserObserver;
use Addons\Plugins\Demo\Middleware\GeneralSettings;
use App\Modules\Core\Controllers\Plugins\Plugin;
use App\Modules\User\Models\User;

class Demo extends Plugin
{
    /**
     * Plugin identifier.
     */
    const IDENTIFIER = 'Demo';

    /**
     * Initialise the plugin.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setIdentifier(self::IDENTIFIER);

        $this->setLoginCredentials();
        $this->setDemoNotice();
        User::observe(UserObserver::class);

        $this->addMiddlewareToRoute('core.operator.generalsetting.update', GeneralSettings::class);
    }

    /**
     * Plugins can run an installation routine when they are activated. This will typically include adding default
     * values, initialising database tables and so on.
     *
     * @return boolean
     */
    public function activate()
    {
        return true;
    }

    /**
     * Deactivating serves as temporarily disabling the plugin, but the files still remain. This function should
     * typically clear any caches and temporary directories.
     *
     * @return boolean
     */
    public function deactivate()
    {
        return true;
    }

    /**
     * When a plugin is uninstalled, it should be completely removed as if it never was there. This function should
     * delete any created database tables, and any files created outside of the plugin directory.
     *
     * @return boolean
     */
    public function uninstall()
    {
        return true;
    }

    /**
     * Register login credentials so people don't need to register an account / input specified details (the form
     * is pre filled).
     *
     * @return void
     */
    protected function setLoginCredentials()
    {
        view()->composer('operator.*.login', function ($view) {
            session()->flash('_old_input', [ 'email' => 'operator@demo.com' ]);
        });
        view()->composer('operator.*.login_master', function () {
            view()->hook('operator.body_end', function () {
                return "<script>$('input[name=password]').val('demo');</script>";
            });
        });

        view()->composer('frontend.*.login', function ($view) {
            session()->flash('_old_input', [ 'email' => 'user@demo.com' ]);
        });
        view()->composer('frontend.*.index', function () {
            view()->hook('frontend.body_end', function () {
                return "<script>$('input[name=password]').val('demo');</script>";
            });
        });
    }

    /**
     * Set the view hooks to show a privacy notice for the demo.
     *
     * @return void
     */
    protected function setDemoNotice()
    {
        $notice = <<<END
<div id="sp-demo-notice" class="sp-fixed sp-bottom-0 sp-start-0 sp-z-10001 sp-w-full sp-px-4 sp-py-2 sp-text-white sp-text-center" style="background: rgba(0, 0, 0, 0.8)">
    This is the SupportPal <a class="sp-text-white hover:sp-text-white" style="text-decoration: underline" href="https://www.supportpal.com/product/demo" target="_blank">product demo</a>. By
    continuing to navigate this website you agree to our 
    <a class="sp-text-white hover:sp-text-white" style="text-decoration: underline" href="https://www.supportpal.com/company/terms" target="_blank">Terms of Service</a>
    and <a class="sp-text-white hover:sp-text-white" style="text-decoration: underline" href="https://www.supportpal.com/company/privacy" target="_blank">Privacy Policy</a>.
</div>
END;

        $this->setFrontendNotice($notice);
        $this->setOperatorNotice($notice);
    }

    /**
     * Add operator demo notice.
     *
     * @param  string $notice
     * @return void
     */
    protected function setOperatorNotice($notice)
    {
        view()->hook('operator.content_end', function () use ($notice) {
            return $notice;
        });

        view()->hook('operator.body_end', function () {
            return <<<END
<script type="text/javascript">
    $(function () {
        $('body').css('padding-bottom', $('#sp-demo-notice').outerHeight());
        $('.sp-toggle-sidebar').css('bottom', $('#sp-demo-notice').outerHeight());
        $('#sp-demo-notice').removeAttr('id');
    });
</script>
END;
        });
    }

    /**
     * Add frontend demo notice.
     *
     * @param  string $notice
     * @return void
     */
    protected function setFrontendNotice($notice)
    {
        view()->hook('frontend.content_end', function () use ($notice) {
            return $notice;
        });

        view()->hook('frontend.body_end', function () {
            return <<<END
<script type="text/javascript">
    $(function () {
        $('body').css('padding-bottom', $('#sp-demo-notice').outerHeight());
        $('#sp-demo-notice').removeAttr('id');
    });
</script>
END;
        });
    }
}
