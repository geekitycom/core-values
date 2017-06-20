<?php
declare(strict_types=1);

namespace Application\Delivery;

use Dflydev\FigCookies\FigRequestCookies;
use Psr\Http\Message\ServerRequestInterface as Request;

class UpdateAdvancedInput
{
    public function __invoke(Request $request)
    {
        $sessionId = FigRequestCookies::get($request, 'SESSION_ID');

        $body = $request->getParsedBody();

        $submit = isset($body['update']) ? 'update' : 'reset';
        $values = isset($body['values']) ? $body['values'] : '';
        $count = intval($body['count'] ?? 1);

        return [$sessionId->getValue(), $submit, $values, $count];
    }
}
