<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OperationService;
use App\Services\AuthService;
class AuthController extends Controller
{
    //
    protected AuthService $_authService;
    protected OperationService $_operationService;

    public function __construct(AuthService $authService, OperationService $operationService )
    {
        $this->_authService = $authService;
        $this->_operationService = $operationService;
    }


     //register user
     public function registerUser(Request $request)
     {
         try {
             $rData = $request->only(["last_name","first_name", "phone_number","password","role_id","specialite","allergie", 'antecedent']);
             
             $validator = [
                 'last_name' => ['required'],
                 'first_name' => ['required'],
                 'phone_number' => ['required', 'unique:profils,telephone' ],
                 'password' => ['required'],
                 'role_id' => ['required','exists:roles,id'],
                 'specialite' => ['nullable'],
                 'allergie' => ['nullable'],
                 'antecedent' => ['nullable'],
 
                
             ];
             $validationMessages = ['last_name.required' => 'Le prénom est requis', 'first_name.required' => 'Le nom de famille est requis', 'phone_number.required' => 'Le numéro de téléphone est requis',
              'password.required' => 'Le mot de passe est requis', 'email_address.email' => 'Veuillez fournir une adresse email valide', 
              'email_address.unique' => 'Cette adresse email est déja utilisée', 'phone_number.unique' => 'Ce numéro de téléphone est déjà pris'];
 
             $validatorResult = Validator::make($rData, $validator, $validationMessages); //
             if ($validatorResult->fails()) {
                 return response()->json([
                     'data' => $validatorResult->errors()->first(),
                     'status' => "error",
                     'message' => $validatorResult->errors()->first(), // "Veuillez fournir des informations valides pour créer le compte",
                 ], 400);
             }
 
             //get data as variables
             $lastName = $rData["last_name"];
             $firstName = $rData["first_name"];
             $email_address = $rData["email_address"];
             $phone_number= $rData["phone_number"];
             $password= $rData["password"];
             $role= $rData["role_id"];
             if(isset($rData["specialite"])){
                 $specialite= $rData["specialite"];
 
             }
             $specialite= null;
             if(isset($rData["allergie"])){
                 $allergie= $rData["allergie"];
 
             }
             $allergie= null;
             if(isset($rData["antecedent"])){
                 $antecedent= $rData["antecedent"];
 
             }
             $antecedent= null;
            
             //do operation
              $this->_authService->registerUser($lastName, $firstName,$email_address, $phone_number,$password,$role, $specialite, $allergie, $antecedent);
 
           
             //check on data
            
             
             return response()->json([
                 'data' => "",
                 'status' => "success",  'message' => "Le compte a été créé avec succès",
             ],200);
 
         } catch (Exception $ex) {
            
 
             //error result
             return response()->json([
                 'data' => "",
                 'status' => "error",
                 'message' => $ex->getMessage(),
             ], 400);
         } catch (Exception $ex) {
             //log exception
           
 
             //error result
             return response()->json([
                 'data' => "",
                 'status' => "error",
                 'message' => "Une erreur est survenue pendant l'inscription. Veuillez réessayer",
             ], 400);
         }
     } //end registerUser
 
 
 
}
