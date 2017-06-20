<?php
declare(strict_types=1);

namespace Application\Delivery;

use Dflydev\FigCookies\FigRequestCookies;
use Psr\Http\Message\ServerRequestInterface as Request;

class RecordVoteInput
{
    public function __invoke(Request $request)
    {
        $sessionId = FigRequestCookies::get($request, 'SESSION_ID');

        $body = $request->getParsedBody();

        $submit = isset($body['choice']) ? 'choice' : 'reset';
        $choice = isset($body['choice']) ? $body['choice'] : '';
        $idx = intval($body['idx'] ?? 0);

        return [$sessionId->getValue(), $submit, $choice, $idx];
    }
}
