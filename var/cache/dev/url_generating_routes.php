<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], [], []],
    '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], [], []],
    '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], [], []],
    '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], [], []],
    '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], [], []],
    '_profiler_xdebug' => [[], ['_controller' => 'web_profiler.controller.profiler::xdebugAction'], [], [['text', '/_profiler/xdebug']], [], [], []],
    '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], [], []],
    '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::body'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception_panel::stylesheet'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], [], []],
    'add-group' => [[], ['_controller' => 'App\\Controller\\CategoryController::addCategory'], [], [['text', '/tricks/nouveau-groupe']], [], [], []],
    'app_comment' => [[], ['_controller' => 'App\\Controller\\CommentController::index'], [], [['text', '/comment']], [], [], []],
    'connexion' => [[], ['_controller' => 'App\\Controller\\LoginLogoutController::login'], [], [['text', '/user/login']], [], [], []],
    'passwordreset' => [[], ['_controller' => 'App\\Controller\\PasswordResetController::passwordReset'], [], [['text', '/user/password-reset']], [], [], []],
    'resetpassword' => [[], ['_controller' => 'App\\Controller\\PasswordResetController::resetPassword'], [], [['text', '/reset-password']], [], [], []],
    'app_picture' => [[], ['_controller' => 'App\\Controller\\PictureController::index'], [], [['text', '/picture']], [], [], []],
    'add-trick' => [[], ['_controller' => 'App\\Controller\\TrickController::addTrick'], [], [['text', '/tricks/ajout-figure']], [], [], []],
    'show-trick' => [['slug', 'id'], ['_controller' => 'App\\Controller\\TrickController::showTrick'], [], [['variable', '/', '[^/]++', 'id', true], ['variable', '/', '[^/]++', 'slug', true], ['text', '/trick-detail']], [], [], []],
    'delete-trick' => [['id'], ['_controller' => 'App\\Controller\\TrickController::deleteTrick'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/delete-trick']], [], [], []],
    'register' => [[], ['_controller' => 'App\\Controller\\UserController::register'], [], [['text', '/user/inscription']], [], [], []],
    'homepage' => [[], ['_controller' => 'App\\Controller\\HomeController::index'], [], [['text', '/tricks']], [], [], []],
    'useradim' => [[], ['_controller' => 'App\\Controller\\UserController::index'], [], [['text', '/user']], [], [], []],
];
