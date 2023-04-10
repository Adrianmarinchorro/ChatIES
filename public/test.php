<?php

$ldap_host = env('LDAP_HOST');
$ldap_port = env('LDAP_PORT');
$ldap_dn = env('LDAP_USER_DN');
$ldap_password = env('LDAP_USER_PASSWORD');

$ldap_conn = ldap_connect($ldap_host, $ldap_port);
ldap_set_option($ldap_conn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldap_conn) {
    $ldap_bind = @ldap_bind($ldap_conn, $ldap_dn, $ldap_password);
    if ($ldap_bind) {
        echo "LDAP connection successful.";
    } else {
        echo "LDAP connection failed.";
    }
} else {
    echo "LDAP server not found.";
}
