<?php

namespace App\Common\Domain\Security\User;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface ApiUserInterface extends UserInterface, PasswordAuthenticatedUserInterface
{

}