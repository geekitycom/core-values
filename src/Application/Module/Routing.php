<?php
declare(strict_types=1);

namespace Application\Module;

use Application\Domain\About;
use Application\Domain\Advanced;
use Application\Domain\Home;
use Application\Domain\RecordVote;
use Application\Domain\UpdateAdvanced;
use Application\Delivery\RecordVoteInput;
use Application\Delivery\UpdateAdvancedInput;
use Aura\Di\Container;
use Cadre\Module\Module;

class Routing extends Module
{
    public function define(Container $di)
    {
    }

    public function modify(Container $di)
    {
        $adr = $di->get('radar/adr:adr');

        $adr->get('Home', '/', Home::class)
            ->defaults(['_view' => 'home.html.twig']);

        $adr->post('RecordVote', '/', RecordVote::class)
            ->defaults(['_view' => 'home.html.twig'])
            ->input(RecordVoteInput::class);

        $adr->get('About', '/about/', About::class)
            ->defaults(['_view' => 'about.html.twig']);

        $adr->get('Advanced', '/advanced/', Advanced::class)
            ->defaults(['_view' => 'advanced.html.twig']);

        $adr->post('UpdateAdvanced', '/advanced/', UpdateAdvanced::class)
            ->defaults(['_view' => 'advanced.html.twig'])
            ->input(UpdateAdvancedInput::class);
    }
}
