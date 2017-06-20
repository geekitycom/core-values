<?php
declare(strict_types=1);

namespace Application\Domain;

use Cadre\DomainSession\SessionManager;

class Home
{
    private $sessionManager;

    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke($sessionId)
    {
        $session = $this->sessionManager->start($sessionId);

        if (isset($session->data)) {
            list($values, $sorted, $compare, $total, $count) = $session->data;
        } elseif (isset($session->defaults)) {
            list($values, $count) = $session->defaults;
            shuffle($values);
            $sorted = [array_shift($values)];
            $compare = array_shift($values);
            $total = count($values);
        } else {
            $values = array_map('trim', file(__ROOTDIR__ . '/config/values.csv'));
            shuffle($values);
            $sorted = [array_shift($values)];
            $compare = array_shift($values);
            $total = count($values);
            $count = 5;
        }

        $idx = count($sorted) - 1;

        $session->data = [$values, $sorted, $compare, $total, $count];

        $this->sessionManager->finish($session);

        return [
            'success' => true,
            'session' => $session,
            'progress' => round(($total - count($values)) / $total, 2) * 100,
            'compare' => $compare,
            'sorted' => $sorted,
            'idx' => $idx,
        ];
    }
}
