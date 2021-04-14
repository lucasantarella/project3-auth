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

        return User::FromDbRow($results[0]);
    }

    public function getUserByUsername(string $username): ?User
    {
        $results = $this->db->table('users__')
            ->select()
            ->where('username', $username)
            ->limit(1)
            ->fetchAll();

        if (count($results) !== 1)
            return null;

        return User::FromDbRow($results[0]);
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
