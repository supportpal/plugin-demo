<?php
/**
 * File UserObserver.php
 */
namespace App\Plugins\Demo\Events\Observers;

use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class UserObserver
 *
 * @package App\Plugins\Demo\Events\Observers
 */
class UserObserver
{
    /**
     * Saving user model event.
     *
     * @param  User $model
     * @return void
     */
    public function saving(User $model)
    {
        try {
            $user = User::findOrFail($model->id);

            // Prevent updating protected attributes for specific accounts.
            if (in_array($user->email, $this->protectedAccounts())) {
                foreach ($this->protectedAttributes() as $attribute) {
                    unset($model->$attribute);
                }
            }
        } catch (ModelNotFoundException $e) {
            //
        }
    }

    /**
     * Handle the User "deleting" event.
     *
     * @param  User  $user
     * @return bool|void
     */
    public function deleting(User $user)
    {
        // Prevent deleting specific accounts.
        if (in_array($user->email, $this->protectedAccounts())) {
            return false;
        }
    }

    /**
     * Prevent changing these attributes on protected accounts.
     *
     * @return array
     */
    protected function protectedAttributes()
    {
        return ['email', 'password', 'active', 'twofa_enabled'];
    }

    /**
     * Prevent updating attributes on certain accounts.
     *
     * @return array
     */
    protected function protectedAccounts()
    {
        return ['user@demo.com', 'operator@demo.com'];
    }
}
