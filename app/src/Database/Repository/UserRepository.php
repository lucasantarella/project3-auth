<?php


namespace App\Database\Repository;


use App\Database\User;
use DateTime;
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

        return $this->getUserById($token->getPayload()['userID']);
    }

    public function getUserById(string $id): ?User
    {
        $results = $this->db->table('users__')
            ->select()
            ->where('id', $id)
            ->limit(1)
            ->fetchAll();

        if (count($results) !== 1)
            return null;

        $user = new User();
        $user->id = $results[0]['id'];
        $user->username = $results[0]['username'];
        $user->password = $results[0]['password'];
        $user->first_name = $results[0]['first_name'];
        $user->last_name = $results[0]['last_name'];
        $user->email = $results[0]['email'];
        $user->status = $results[0]['status'];
        $user->created_at = $results[0]['created_at'];
        return $user;
    }

    /**
     * @param User $user
     * @return int|string|null
     */
    public function createUser(User $user)
    {
        return $this->db->table('users__')
            ->insertOne([
                'id' => $user->id,
                'username' => $user->username,
                'password' => $user->password,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'status' => $user->status,
                'created_at' => new DateTime(),
            ]);
    }

}
