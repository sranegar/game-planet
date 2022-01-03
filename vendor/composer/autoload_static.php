<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit359a6ff1efe5051341bfffa51d7ba653
{
    public static $classMap = array (
        'AddGame' => __DIR__ . '/../..' . '/views/games/add/add_game.class.php',
        'AddGameConfirmation' => __DIR__ . '/../..' . '/views/games/add/add_game_confirmation.class.php',
        'AddSystem' => __DIR__ . '/../..' . '/views/systems/add/add_system.class.php',
        'AddSystemConfirmation' => __DIR__ . '/../..' . '/views/systems/add/add_system_confirmation.class.php',
        'Admin' => __DIR__ . '/../..' . '/views/users/login/admin.class.php',
        'BannerController' => __DIR__ . '/../..' . '/controllers/banner_controller.class.php',
        'BannerModel' => __DIR__ . '/../..' . '/models/banner_model.class.php',
        'CartController' => __DIR__ . '/../..' . '/controllers/cart_controller.class.php',
        'CartModel' => __DIR__ . '/../..' . '/models/cart_model.class.php',
        'CartSession' => __DIR__ . '/../..' . '/session/cart_session.class.php',
        'Checkout' => __DIR__ . '/../..' . '/views/shopping_cart/checkout/checkout.class.php',
        'ComposerAutoloaderInit359a6ff1efe5051341bfffa51d7ba653' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit359a6ff1efe5051341bfffa51d7ba653' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'CreateAccount' => __DIR__ . '/../..' . '/views/users/register/create_account.class.php',
        'DataFormatException' => __DIR__ . '/../..' . '/exceptions/data_format_exception.php',
        'DataLengthException' => __DIR__ . '/../..' . '/exceptions/data_length_exception.class.php',
        'DataMissingException' => __DIR__ . '/../..' . '/exceptions/data_missing_exception.class.php',
        'DataNotFoundException' => __DIR__ . '/../..' . '/exceptions/data_not_found_exception.class.php',
        'Database' => __DIR__ . '/../..' . '/application/database.class.php',
        'DatabaseException' => __DIR__ . '/../..' . '/exceptions/database_exception.class.php',
        'Dispatcher' => __DIR__ . '/../..' . '/application/dispatcher.class.php',
        'EditGame' => __DIR__ . '/../..' . '/views/games/edit/edit_game.class.php',
        'EditSystem' => __DIR__ . '/../..' . '/views/systems/edit/edit_system.class.php',
        'EmailFormatException' => __DIR__ . '/../..' . '/exceptions/email_format_exception.class.php',
        'FilterGames' => __DIR__ . '/../..' . '/views/games/filter/filter_games.class.php',
        'Game' => __DIR__ . '/../..' . '/models/game.class.php',
        'GameController' => __DIR__ . '/../..' . '/controllers/game_controller.class.php',
        'GameDetails' => __DIR__ . '/../..' . '/views/games/details/game_details.class.php',
        'GameError' => __DIR__ . '/../..' . '/views/games/error/GameError.php',
        'GameIndex' => __DIR__ . '/../..' . '/views/games/index/game_index.class.php',
        'GameModel' => __DIR__ . '/../..' . '/models/game_model.class.php',
        'IndexView' => __DIR__ . '/../..' . '/views/index_view.class.php',
        'Login' => __DIR__ . '/../..' . '/views/users/login/login.class.php',
        'Logout' => __DIR__ . '/../..' . '/views/users/logout/logout.class.php',
        'Register' => __DIR__ . '/../..' . '/views/users/register/register.class.php',
        'RemoveFromCart' => __DIR__ . '/../..' . '/views/shopping_cart/remove/remove_from_cart.class.php',
        'RestrictedAccessException' => __DIR__ . '/../..' . '/exceptions/restricted_access_exception.php',
        'SearchIndex' => __DIR__ . '/../..' . '/views/games/search/search_index.class.php',
        'SearchSystemIndex' => __DIR__ . '/../..' . '/views/systems/search/search_system_index.class.php',
        'ShoppingCart' => __DIR__ . '/../..' . '/models/shopping_cart.class.php',
        'System' => __DIR__ . '/../..' . '/models/system.class.php',
        'SystemController' => __DIR__ . '/../..' . '/controllers/system_controller.class.php',
        'SystemDetails' => __DIR__ . '/../..' . '/views/systems/details/system_details.class.php',
        'SystemIndex' => __DIR__ . '/../..' . '/views/systems/index/system_index.class.php',
        'SystemModel' => __DIR__ . '/../..' . '/models/system_model.class.php',
        'TopGame' => __DIR__ . '/../..' . '/models/top_game.class.php',
        'TopSystem' => __DIR__ . '/../..' . '/models/top_system.class.php',
        'UserController' => __DIR__ . '/../..' . '/controllers/user_controller.class.php',
        'UserModel' => __DIR__ . '/../..' . '/models/user_model.class.php',
        'Utilities' => __DIR__ . '/../..' . '/application/utilities.class.php',
        'Verify' => __DIR__ . '/../..' . '/views/users/login/verify.class.php',
        'ViewCart' => __DIR__ . '/../..' . '/views/shopping_cart/index/view_cart.class.php',
        'WelcomeController' => __DIR__ . '/../..' . '/controllers/welcome_controller.class.php',
        'WelcomeIndex' => __DIR__ . '/../..' . '/views/welcome/welcome_index.class.php',
        'WelcomeIndexView' => __DIR__ . '/../..' . '/views/welcome_index_view.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit359a6ff1efe5051341bfffa51d7ba653::$classMap;

        }, null, ClassLoader::class);
    }
}
