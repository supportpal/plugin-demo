<?php declare(strict_types=1);

namespace Addons\Plugins\Demo\Events\Observers;

use App\Modules\User\Models\Enums\UserRole;
use App\Modules\User\Models\User;

use function array_merge;

class UserObserver
{
    public function updating(User $model): void
    {
        if (! $this->isProtectedAccount($model)) {
            return;
        }

        $attributes = [];
        foreach ($this->protectedAttributes() as $attribute) {
            $default = 'uninitialized';
            $original = $model->getRawOriginal($attribute, $default);
            if ($original === $default) {
                continue;
            }

            $attributes[$attribute] = $original;
        }

        $model->setRawAttributes(array_merge($model->getAttributes(), $attributes));
    }

    public function deleting(User $user): ?bool
    {
        if ($this->isProtectedAccount($user)) {
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

    protected function isProtectedAccount(User $user): bool
    {
        $email = $user->exists ? $user->getOriginal('email') : $user->email;

        return ($user->role === UserRole::Operator && $email === 'operator@demo.com')
            || ($user->role === UserRole::User && $email === 'user@demo.com');
    }
}
