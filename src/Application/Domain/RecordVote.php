<?php
declare(strict_types=1);

namespace Application\Domain;

use Cadre\DomainSession\SessionManager;

class RecordVote
{
    private $sessionManager;

    public function __construct(SessionManager $sessionManager)
    {
        $this->sessionManager = $sessionManager;
    }

    public function __invoke($sessionId, $submit, $choice, $idx)
    {
        $session = $this->sessionManager->start($sessionId);

        if (0 === strcmp('reset', $submit)) {
            unset($session->data);
        }

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

        if (0 === strcmp('choice', $submit)) {
            if (0 === strcmp($sorted[$idx], $choice)) {
                // $compare is less important than $idx
                array_splice($sorted, $idx + 1, 0, $compare);
                $compare = array_shift($values);
                $idx = count($sorted) - 1;
            } elseif (0 === strcmp($compare, $choice)) {
                // $compare is more important than $idx
                if (0 === $idx) {
                    // $compare is most important item
                    array_splice($sorted, $idx, 0, $compare);
                    $compare = array_shift($values);
                    $idx = count($sorted) - 1;
                } else {
                    // Need to check $compare against next highest item
                    $idx--;
                }
            } else {
                return [
                    'success' => false,
                    'message' => 'Invalid Choice',
                ];
            }
        }

        // We only care about the top $count items
        $sorted = array_slice($sorted, 0, $count);
        if ($idx > ($count-1)) {
            $idx = ($count-1);
        }

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
