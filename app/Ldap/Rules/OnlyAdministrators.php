<?php

namespace App\Ldap\Rules;

use Dotenv\Util\Str;
use LdapRecord\Container;
use LdapRecord\Laravel\Auth\Rule;

class OnlyAdministrators extends Rule
{
    /**
     * Check if the rule passes validation.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        $ldap_group = env('LDAP_GROUP');

        if (!isset($ldap_group)){
            return false;
        }

        $gidNumber = explode( ',', $this->user->getFirstAttribute('gidNumber'));

        $connection = Container::getDefaultConnection();
        $query = $connection->query()->where('cn', $ldap_group);

        $results = $query->get();

        return $gidNumber[0] == $results[0]['gidnumber'][0];
    }
}
