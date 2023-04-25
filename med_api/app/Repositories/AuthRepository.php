<?php

namespace App\Repositories;
use Exception;
use App\Models\Utilisateur;
use App\Models\Patient;
use App\Models\Background;
use App\Interfaces\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function registerUser($lastName, $firstName, $phone_number,$password,$role,  $reference, $specialite, $allergies, $antecedents)
    {
      try {
  
        $user = new Utilisateur();
        $user->nom = $firstName;
        $user->prenom = $lastName;
        $user->telephone = $phone_number ;
        $user->password = $password;
        $user->role_id = $role;
        $user->reference = $reference;
        $user->specialite = $specialite;       
        $user->save() ;

        $backgroundAllergie = Background::where('libelle','like','allergie')->first();
        $backgroundAntecedent = Background::where('libelle','like','antecedent')->first();
        if (isset($allergies)){
            foreach ($allergies as $allergie){
                $patient =new Patient();
                $patient->utilisateur_id = $user->id;
                $patient->background_id = $backgroundAllergie->id;
                $patient->description = $allergie;
                $patient->save();
            }
        }
        if (isset($antecedents)){

            foreach ($antecedents as $antecedent){
                $patient =new Patient();
                $patient->utilisateur_id = $user->id;
                $patient->background_id =  $backgroundAntecedent->id;
                $patient->description = $antecedent;
                $patient->save();
            }
        }

       
        }catch (Exception $ex) {
        throw $ex;
      }
    } 
}