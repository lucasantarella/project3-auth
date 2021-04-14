<?php

/**
 * This file is part of Spiral package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Bootloader;

use App\Controller\LoginController;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Router\Route;
use Spiral\Router\RouterInterface;
use Spiral\Router\Target\Action;
use Spiral\Router\Target\Controller;

class RoutesBootloader extends Bootloader
{
    /**
     * Bootloader execute method.
     *
     * @param RouterInterface $router
     */
    public function boot(RouterInterface $router): void
    {
        $loginRoute = new Route('/login', new Controller(LoginController::class));

        $router->setRoute(
            'login.get',
            $loginRoute->withVerbs('GET')->withDefaults(['action' => 'get'])
        );

        $router->setRoute(
            'login.post',
            $loginRoute->withVerbs('POST')->withDefaults(['action' => 'post'])
        );

    }
}
