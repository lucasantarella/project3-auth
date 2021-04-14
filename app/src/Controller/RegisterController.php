<?php


namespace App\Controller;


use App\Database\Repository\UserRepository;
use App\Database\User;
use App\Request\RegisterRequest;
use Ramsey\Uuid\Uuid;
use Spiral\Database\Exception\StatementException\ConstrainException;
use Spiral\Prototype\Traits\PrototypeTrait;

class RegisterController
{

    use PrototypeTrait;

    /**
     * @return string
     */
    public function get(): string
    {
        return $this->views->render('register.dark.php');
    }

    /**
     * @return string
     */
    public function post(RegisterRequest $request, UserRepository $userRepository): string
    {
        $user = new User();
        $user->id = Uuid::uuid4()->toString();
        $user->username = $request->getField('username');
        $user->password = password_hash($request->getField('password'), PASSWORD_DEFAULT);
        $user->first_name = $request->getField('first_name');
        $user->last_name = $request->getField('last_name');
        $user->email = $request->getField('email');
        $user->status = 1;

        try {
            $userRepository->createUser($user);
        } catch (ConstrainException $e) {
            // do nothing, don't let the hacker know an account exists
            // this is security best practice
        }

        return $this->views->render('register_success.dark.php');
    }

}
