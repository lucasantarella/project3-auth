<?php


namespace App\Controller;


use Spiral\Http\Exception\ClientException\ForbiddenException;
use Spiral\Prototype\Traits\PrototypeTrait;

class AuthenticatedController
{
    use PrototypeTrait;

    public function index()
    {
        if ($this->auth->getActor() === null) {
            throw new ForbiddenException();
        }

        dump($this->auth->getActor());
    }

}
