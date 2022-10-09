<?php

use Laravel\Jetstream\Features;
use Laravel\Jetstream\Http\Middleware\AuthenticateSession;

return [

    /*
    |--------------------------------------------------------------------------
    | Jetstream Stack
    |--------------------------------------------------------------------------
    |
    | This configuration value informs Jetstream which "stack" you will be
    | using for your application. In general, this value is set for you
    | during installation and will not need to be changed after that.
    |
    */

    'stack' => 'livewire',

    /*
     |--------------------------------------------------------------------------
     | Jetstream Route Middleware
     |--------------------------------------------------------------------------
     |
     | Here you may specify which middleware Jetstream will assign to the routes
     | that it registers with the application. When necessary, you may modify
     | these middleware; however, this default value is usually sufficient.
     |
     */

    'middleware' => ['web'],

    'auth_session' => AuthenticateSession::class,

    /*
    |--------------------------------------------------------------------------
    | Jetstream Guard
    |--------------------------------------------------------------------------
    |
    | Here you may specify the authentication guard Jetstream will use while
    | authenticating users. This value should correspond with one of your
    | guards that is already present in your "auth" configuration file.
    |
    */

    'guard' => 'sanctum',

    /*
    |--------------------------------------------------------------------------
    | Features
    |--------------------------------------------------------------------------
    |
    | Some of Jetstream's features are optional. You may disable the features
    | by removing them from this array. You're free to only remove some of
    | these features or you can even remove all of these if you need to.
    |
    */

    /*
        ici se troiuve d'autre features notament la photot de profil ou la possibilite de supprimer le compte
        il existe dautre features dans le fichier fortify.php à voir
    */
    'features' => [
        // Features::termsAndPrivacyPolicy(),

        Features::profilePhotos(),
        /*
            par defaut si tu veux utiliser cette feature la photot de profile qui sera genere sera la premiere lettre de ton utilisateur
            si tu veux mettre une vrai image qui vient de ton pc elle sera cassée comment y remedier ?? --> -tu upload une photot 

                            -tu l'ouvre dans un nouvelle oglet et tu remarque cette url : http://localhost/storage/profile-photos/iV9aX1kirHgjcnHiH6ztMpPKN8aJK5h258Zvkq9s.png

                            -on a un unique id qui a ete genere pour ton image mais on a aussi le chemin qu commence par http://localhost alors qu'on travaille sur l'url http://127.0.0.1:8000 donc tu vas le changer dans le fichier .env dans "APP_URL"

                            -normalement mnt on va s'occuper du fichier de stockage des photot qui est ici 'profile-photos' qui s situe dans le storage mais pas la peine avec la nouvelle maj de laravel9 c fait automatiquement ( si cela n'est pas fait automatiquement tu aurai du tapper la commande 'php artisan storage:link' )

                            -voila tt est pret pour utiliser cette feature maintenant
        */

        // Features::api(),
        // Features::teams(['invitations' => true]),
        Features::accountDeletion(),
    ],

    /*
    |--------------------------------------------------------------------------
    | Profile Photo Disk
    |--------------------------------------------------------------------------
    |
    | This configuration value determines the default disk that will be used
    | when storing profile photos for your application's users. Typically
    | this will be the "public" disk but you may adjust this if needed.
    |
    */

    'profile_photo_disk' => 'public',

];
