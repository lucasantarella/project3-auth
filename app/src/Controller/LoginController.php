<?php


namespace App\Controller;


use App\Database\Repository\UserRepository;
use App\Request\LoginRequest;
use DateTimeImmutable;
use Lcobucci\JWT\Configuration as JwtConfiguration;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;
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
    public function post(LoginRequest $login, UserRepository $userRepository, JwtConfiguration $jwtConfig): ResponseInterface
    {
        if (!$login->isValid()) {
            return $this->response->json([
                'status' => 400,
                'errors' => $login->getErrors()
            ]);
        }

        // application specific login logic
        $user = $userRepository->getUserByUsername($login->getField('username'));
        if (
            $user === null
            || !password_verify($login->getField('password'), $user->password)
        ) {
            return $this->response->json([
                'status' => 400,
                'error' => 'No such user'
            ]);
        }

        // create token
        $this->auth->start(
            $this->authTokens->create(['userID' => $user->id])
        );

        // create id_token
        $now = new DateTimeImmutable();
        $jwt = $jwtConfig->builder()
            ->issuedBy('https://cs490.lucasantarella.com')
            ->permittedFor('https://cs490.lucasantarella.com')
            ->identifiedBy(Uuid::uuid4())
            ->issuedAt($now)
            ->expiresAt($now->modify('+1 hour'))
            ->withClaim('uid', (string)$user->id)
            ->withClaim('name', implode(' ', [$user->first_name, $user->last_name]))
            ->withClaim('email', $user->email)
            ->withClaim('un', $user->username)
            ->getToken($jwtConfig->signer(), $jwtConfig->signingKey());
        $this->cookies->set('jwt', $jwt->toString(), $now->modify('+1 hour')->getTimestamp(), null, null, null, false);
        return $this->response
            ->redirect('/dashboard', 302)
            ->withAddedHeader('x-jwt', $jwt->toString());
    }

}
