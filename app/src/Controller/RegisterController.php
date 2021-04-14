<?php


namespace App\Controller;


use Spiral\Prototype\Traits\PrototypeTrait;

class LoginController
{

    use PrototypeTrait;

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->views->render('login.dark.php');
    }

    /**
     * @return string
     */
    public function post(): string
    {
        return 'do login';
    }

}
