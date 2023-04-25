<?php

namespace App\Interfaces;



interface AuthRepositoryInterface
{
      //register user
      public function registerUser($lastName, $firstName, $phone_number,$password,$role,  $reference, $specialite, $allergies, $antecedents);
}
