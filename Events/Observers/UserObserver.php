<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Events\Observers;

use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserObserver
{
    public function saving(User $model): void
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

    public function deleting(User $user): ?bool
    {
        // Prevent deleting specific accounts.
        if (in_array($user->email, $this->protectedAccounts())) {
            return false;
        }

        return null;
    }

    /**
     * Prevent changing these attributes on protected accounts.
     *
     * @return string[]
     */
    protected function protectedAttributes(): array
    {
        return ['email', 'password', 'active', 'twofa_enabled'];
    }

    /**
     * Prevent updating attributes on certain accounts.
     *
     * @return string[]
     */
    protected function protectedAccounts(): array
    {
        return ['user@demo.com', 'operator@demo.com'];
    }
}
