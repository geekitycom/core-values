<?php
declare(strict_types=1);

namespace Application\Module;

use Application\Domain\About;
use Application\Domain\Advanced;
use Application\Domain\Home;
use Application\Domain\RecordVote;
use Application\Domain\UpdateAdvanced;
use Aura\Di\Container;
use Cadre\Module\Module;
use Cadre\DomainSession\SessionManager;
use Cadre\DomainSession\Storage\Files;

class Domain extends Module
{
    public function define(Container $di)
    {
        $di->params[Files::class] = [
            'path' => __ROOTDIR__ . '/sessions',
        ];

        $di->params[SessionManager::class] = [
            'storage' => $di->lazyNew(Files::class),
        ];

        $di->params[About::class] = [
            'sessionManager' => $di->lazyNew(SessionManager::class),
        ];

        $di->params[Advanced::class] = [
            'sessionManager' => $di->lazyNew(SessionManager::class),
        ];

        $di->params[Home::class] = [
            'sessionManager' => $di->lazyNew(SessionManager::class),
        ];

        $di->params[RecordVote::class] = [
            'sessionManager' => $di->lazyNew(SessionManager::class),
        ];

        $di->params[UpdateAdvanced::class] = [
            'sessionManager' => $di->lazyNew(SessionManager::class),
        ];
    }

    public function modify(Container $di)
    {
    }
}
