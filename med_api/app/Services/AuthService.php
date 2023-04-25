<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Repositories\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Exception;

class AuthService {

    protected AuthRepository $_authRepository;
    public function __construct(AuthRepository $authRepository)
{
   $this->_authRepository=$authRepository;
   
}



    //register user
    public function registerUser($lastName, $firstName, $phone_number,$password,$role, $specialite, $allergies, $antecedents){

        try {
        //check on gender
    

        $phoneNumber = strtoupper(trim($phone_number));
        if (!preg_match('/[0-9]{2}/', $phoneNumber)) {
            throw new Exception("Veuillez entrer un numéro de téléphone valide.");
        }

        //la longueur minimum du password doit etre 5 caracteres
        if (strlen($password) < 5) {
            throw new Exception("Veuillez entrer un mot de passe valide comportant un minimum de cinq caractères.");
        }

       

        //hash password
        $password = Hash::make($password);
        $reference =  (string) Str::orderedUuid(); 
      
        //register user
        $creationResult = $this->_authRepository->registerUser($lastName, $firstName, $phone_number,$password,$role,  $reference, $specialite, $allergies, $antecedents);
        


        return $creationResult;

        } catch (\Exception $th) {
            throw $th;
        }

}//end registerUser


}