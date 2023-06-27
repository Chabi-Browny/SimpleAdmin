<?php

namespace App\Helper;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
/**
 * Description of PasswordHasher
 */
class PasswordHasher
{
    protected $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function getHashedPassword()
    {
        $retVal = false;

        // retrieve the hasher using bcrypt
        $hasher = (new PasswordHasherFactory([ 'common' => ['algorithm' => 'bcrypt'] ]))
            ->getPasswordHasher('common');

        $hash = $hasher->hash($this->password);

        if ($hasher->verify($hash, $this->password))
        {
            $retVal = $hash;
        }

        return $retVal;
    }

}
