<?php
declare(strict_types=1);

namespace Application\Domain;

use Cadre\DomainSession\SessionManager;

class UpdateAdvanced
{
    private $sessionManager;

    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke($sessionId, $submit, $values, $count)
    {
        $session = $this->sessionManager->start($sessionId);

        if (0 === strcmp('reset', $submit)) {
            unset($session->defaults);
            unset($session->data);
            $values = array_map('trim', file(__ROOTDIR__ . '/config/values.csv'));
            $count = 5;
        }

        if (0 === strcmp('update', $submit)) {
            $values = array_filter(array_map('trim', explode("\n", $values)));
            $count = intval($count) < 1 ? 1 : intval($count);
            $session->defaults = [$values, $count];
            unset($session->data);
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
