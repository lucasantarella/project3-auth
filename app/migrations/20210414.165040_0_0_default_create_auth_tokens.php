<?php

namespace Migration;

use Spiral\Migrations\Migration;

class OrmDefault6e8bce0ed265da434bea8088fa3aa4ed extends Migration
{
    protected const DATABASE = 'default';

    public function up()
    {
        $this->table('auth_tokens')
            ->addColumn('id', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 64
            ])
            ->addColumn('hashed_value', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 128
            ])
            ->addColumn('created_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->addColumn('expires_at', 'datetime', [
                'nullable' => true,
                'default'  => null
            ])
            ->addColumn('payload', 'binary', [
                'nullable' => false,
                'default'  => null
            ])
            ->setPrimaryKeys(["id"])
            ->create();

        $this->table('users__')
            ->addColumn('id', 'string', [
                'nullable' => false,
                'default'  => null,
                'size'     => 32
            ])
            ->addColumn('username', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('password', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('first_name', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('last_name', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('email', 'string', [
                'nullable' => false,
                'default'  => null,
            ])
            ->addColumn('status', 'int', [
                'nullable' => false,
                'size'     => 1,
                'default'  => 1,
            ])
            ->addColumn('created_at', 'datetime', [
                'nullable' => false,
                'default'  => null
            ])
            ->setPrimaryKeys(["id"])
            ->create();
    }

    public function down()
    {
        $this->table('auth_tokens')->drop();
    }
}
