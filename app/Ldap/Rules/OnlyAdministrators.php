<?php

namespace App\Ldap\Rules;

use Dotenv\Util\Str;
use LdapRecord\Laravel\Auth\Rule;

class OnlyAdministrators extends Rule
{
    /**
     * Check if the rule passes validation.
     *
     * @return bool
     */
    public function isValid()
    {
        $cn = explode( ',', $this->user->getDn());

        return $cn[1] == 'cn=Chatuser' ?? false;
    }
}
