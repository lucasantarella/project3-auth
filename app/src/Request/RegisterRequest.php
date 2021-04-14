<?php


namespace App\Request;


use Spiral\Filters\Filter;

class RegisterRequest extends Filter
{

    public const SCHEMA = [
        'email' => 'data:email',
        'username' => 'data:username',
        'password' => 'data:password',
        'first_name' => 'data:first_name',
        'last_name' => 'data:last_name'
    ];

    public const VALIDATES = [
        'email' => ['notEmpty'],
        'username' => ['notEmpty'],
        'password' => ['notEmpty'],
        'first_name' => ['notEmpty'],
        'last_name' => ['notEmpty']
    ];

}
