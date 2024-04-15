<?php

namespace App\Http\Controllers;
use App\Mail\AccountMail;
use App\Mail\ContactMail;
use App\Services\AccountGeneralService;
use App\Services\AuthenticationService;
use App\Services\SignUpService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $signupService;
    protected $authenticationService;
    protected $accountGeneralService;

    public function __construct( AuthenticationService $authentication_Service, AccountGeneralService $accountGeneral_Service)
    {
       
        $this->authenticationService = $authentication_Service;
        $this->accountGeneralService = $accountGeneral_Service;
    }
    //register account for user
    // public function register(Request $request){
    //     try {
    //         $validateData = $request->validate([
    //             'username' => 'required|max:255',
    //             'email' => 'required|email|max:255',
    //             'password' => 'required|min:6'
                
    //         ]);
    //         $validateData['role'] = 1;
    //         $token='';
            
    //         $user = $this->authenticationService->SignUp($validateData);
    //         Mail::to($request->input("email"))->send(new AccountMail($request->input("username"),$token,$request->input("password")));

    //         return response()->json($user,200);
    //     } catch (\Exception $th) {
    //         return response()->json(['error' => $th->getMessage()], 500);
    //     }
    // }
    
    public function register(Request $request){
        try {
            $validateData = $request->validate([
                'username' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:6',
                'idCountry' => 'numeric'
                
            ]);
            $validateData['role'] = 1;
            
            $token='';  
            $checkExist = $this->authenticationService->checkExistEmailUsername($request->input('username'),$request->input('email'));     
            if($checkExist==null){
                $user = $this->authenticationService->SignUp($validateData);
                Mail::to($request->input("email"))->send(new AccountMail($request->input("username"),$token,$request->input("password")));
    
                return response()->json($user,200);
            }else{
                return response()->json(['error' => 'Email or Username existed'], 500);
            }
        } catch (\Exception $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }  
    //function login
    public function logIn(Request $request){
        try {
            $validateDate = $request->validate([
                'email' => 'required|email|max:255',
                'password' => 'required|min:6'
            ]);
           $result = $this->authenticationService->SignIn($validateDate);
           if($result){
            return response()->json([
                200,
                'user' => $result['user']
            ]);
           }else{
            return response()->json(['error' => 'invalid'],401);
           }

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function change password for user
    public function changePassword($id){
        $validateData = [
            'password' => 'required|max:255'
        ];
        try {
            $users = $this->authenticationService->changePassword($validateData,$id);
            return response()->json(['success'=>'change password success'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function forgot password for user
    public function forgetPassword(Request $request){
        try {
            $user = $this->authenticationService->findByEmail($request->input('email'));
            if($user){
                $validateData=[
                    'password' => 'required|max:255'
                ];
                $users = $this->authenticationService->forgotPassword($validateData, $user['id']);
            }
            return response()->json(['success'=>'change password success'],200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    //function edit customer account
    public function editCustomer(Request $request,$id){
        try {
            $validateData = $request->validate([
                'username' => 'max:255',
                'fullname'=>'required|max:255',
                'firstname'=>'required|max:255',
                'lastname'=>'required|max:255',
                'subscription'=>'required|max:255',
            ]);
            $admins = $this->accountGeneralService->editAccount($validateData,$id);
            return response()->json($admins,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    
}
