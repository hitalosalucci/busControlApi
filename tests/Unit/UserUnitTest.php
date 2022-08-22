<?php

namespace Tests\Unit;

use App\Models\User;
use App\Transactions\User\AddUserTransaction;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    private $name = 'Usuário de Teste Souza Oliveira';
    private $login = 'usuarioadmin.aguiabranca';
    private $email = 'usuariodetesteadmin@aguiabranca.com';
    private $password = 'SEnHDeTeSteFoRtE654321@%!"+(45(SsAaZz):;/.,zZXsAWQ=_-abc@123';
    private $level = 'admin';

    public function testAddUserAdmin()
    {

        $transaction = new AddUserTransaction($this->name, $this->login, $this->email, $this->password, $this->level);
        $transaction->execute();

        $user = User::first();

        $this->assertNotNull($user, 'Usuário inválido');
        $this->assertNotNull($user->uuid, 'UUID inválido');
        $this->assertEquals($this->name, $user->name, 'Nome incorreto');
        $this->assertEquals($this->login, $user->login, 'Login incorreto');
        $this->assertEquals($this->email, $user->email, 'Email incorreto');
        $this->assertEquals($this->level, $user->level, 'Level incorreto');
        $this->assertTrue($user->validatePassword($this->password), 'Senha do usuário incorreta');
    }

    public function testAddUserSaller()
    {

        $name = 'Usuário de Teste Souza Oliveira';
        $email = 'usuariodeteste@aguiabranca.com';
        $password = 'SEnHDeTeSteFoRtE654321@%!"+(45(SsAaZz):;/.,zZXsAWQ=_-abc@123';
        $login = 'usuariosaller.aguiabranca';
        $level = 'saller';

        $transaction = new AddUserTransaction($name, $login, $email, $password, $level);
        $transaction->execute();

        $user = User::first();

        $this->assertNotNull($user, 'Usuário inválido');
        $this->assertNotNull($user->uuid, 'UUID inválido');
        $this->assertEquals($name, $user->name, 'Nome incorreto');
        $this->assertEquals($login, $user->login, 'Login incorreto');
        $this->assertEquals($email, $user->email, 'Email incorreto');
        $this->assertEquals($level, $user->level, 'Level incorreto');
        $this->assertTrue($user->validatePassword($password), 'Senha do usuário incorreta');
    } 
}
