<?php

namespace Deployer;

require 'recipe/laravel-deployer.php';

/*
 * Includes
 */

/*
 * Options
 */

set('strategy', 'basic');
set('application', 'Jonas\'s Journey');
set('repository', 'git@github.com:harrywebdev/jonas-journey.git');

/*
 * Hosts and localhost
 */

host('potr.cz')
    ->set('deploy_path', '/var/www/jonasova-cesta.potr.cz')
    ->user('hery')
    ->identityFile('~/.ssh/smudlik');

/*
 * Strategies
 */

/*
 * Hooks
 */

after('hook:build', 'npm:install');
after('hook:build', 'npm:production');
after('hook:ready', 'artisan:storage:link');
after('hook:ready', 'artisan:view:clear');
after('hook:ready', 'artisan:cache:clear');
after('hook:ready', 'artisan:config:cache');
after('hook:ready', 'artisan:migrate');