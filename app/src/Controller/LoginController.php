<?php


namespace App\Controller;


use App\Database\Repository\UserRepository;
use App\Request\LoginRequest;
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
     * @param LoginRequest $login
     * @return array
     */
    public function post(LoginRequest $login, UserRepository $userRepository): array
    {
        if (!$login->isValid()) {
            return [
                'status' => 400,
                'errors' => $login->getErrors()
            ];
        }

        // application specific login logic
        $user = $userRepository->findOne(['username' => $login->getField('username')]);
        if (
            $user === null
            || !password_verify($login->getField('password'), $user->password)
        ) {
            return [
                'status' => 400,
                'error' => 'No such user'
            ];
        }

        // create token
    }

}
