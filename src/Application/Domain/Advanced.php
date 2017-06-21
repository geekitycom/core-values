<?php
declare(strict_types=1);

namespace Application\Domain;

use Cadre\DomainSession\SessionManager;

class Advanced
{
    private $sessionManager;

    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke($sessionId)
    {
        $session = $this->sessionManager->start($sessionId);

        if (isset($session->defaults)) {
            list($values, $count) = $session->defaults;
        } else {
            $values = array_map('trim', file(__ROOTDIR__ . '/config/values.csv'));
            $count = 5;
        }

        $this->sessionManager->finish($session);

        return [
            'success' => true,
            'session' => $session,
            'values' => implode("\n", $values),
            'count' => $count,
            'title' => 'Advanced Settings for Core Values',
        ];
    }
}
