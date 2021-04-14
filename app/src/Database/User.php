<?php


namespace App\Database;


class User
{

    public $id;

    public $username;

    public $password;

    public $first_name;

    public $last_name;

    public $email;

    public $status;

    public $created_at;

    public static function FromDbRow(array $row): self
    {
        $user = new self();
        $user->id = $row['id'];
        $user->username = $row['username'];
        $user->password = $row['password'];
        $user->first_name = $row['first_name'];
        $user->last_name = $row['last_name'];
        $user->email = $row['email'];
        $user->status = $row['status'];
        $user->created_at = $row['created_at'];
        return $user;
    }

}
