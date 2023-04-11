<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $ldap_host = 'openldap';
    $ldap_port = env('LDAP_PORT');
    $ldap_dn = env('LDAP_USER_DN');
    $ldap_password = env('LDAP_USER_PASSWORD');

    $ldapconn = ldap_connect($ldap_host, $ldap_port);
    ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

    if ($ldapconn) {
        // Configurar opciones de la conexión, si es necesario
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

        // Autenticarse con el servidor OpenLDAP, si es necesario
        ldap_bind($ldapconn, "cn=admin,dc=example,dc=org", "admin");

        // Realizar la búsqueda en el servidor OpenLDAP
        $searchdn = "ou=usuario,dc=example,dc=org"; // DN del directorio donde se encuentran los usuarios
        $filter = "(uid=amc)"; // Filtro de búsqueda para cn=admin y uid=pepe
        $attributes = array("cn", "uid", "givenName", "sn"); // Atributos que quieres obtener del usuario

        $search = ldap_search($ldapconn, $searchdn, $filter, $attributes);

        if ($search) {
            $entries = ldap_get_entries($ldapconn, $search);
            // Obtener información del usuario de $entries
            if ($entries['count'] > 0) {
                $cn = $entries[0]['cn'][0];
                $uid = $entries[0]['uid'][0];
                echo "Nombre completo: " . $cn . "<br>";
                echo "UID: " . $uid . "<br>";
            } else {
                echo "No se encontró información del usuario en el servidor OpenLDAP";
            }
        } else {
            echo "No se pudo realizar la búsqueda del usuario en el servidor OpenLDAP";
        }

        // Cerrar la conexión al servidor OpenLDAP
        ldap_close($ldapconn);
    } else {
        echo "No se pudo establecer la conexión con el servidor OpenLDAP";
    }

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
