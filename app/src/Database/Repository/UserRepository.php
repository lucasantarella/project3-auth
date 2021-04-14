<?php


namespace App\Database\Repository;


use App\Database\User;
use Spiral\Auth\ActorProviderInterface;
use Spiral\Auth\TokenInterface;
use Spiral\Database\Database;

class UserRepository implements ActorProviderInterface
{

    private Database $db;

    /**
     * UserRepository constructor.
     * @param Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getActor(TokenInterface $token): ?object
    {
        if (!isset($token->getPayload()['userID'])) {
            return null;
        }

        $results = $this->db->table('users__')
            ->select()
            ->where('id', $token->getPayload()['userID'])
            ->limit(1)
            ->fetchAll();

        if (count($results) !== 1)
            return null;

        $user = new User();
        $user->username = $results[0]['username'];
        $user->password = $results[0]['password'];
        $user->first_name = $results[0]['first_name'];
        $user->last_name = $results[0]['last_name'];
        $user->email = $results[0]['email'];
        $user->status = $results[0]['status'];
        $user->created_at = $results[0]['created_at'];
        return $user;
    }

}
