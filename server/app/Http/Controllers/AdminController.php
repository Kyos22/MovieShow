<?php

namespace App\Http\Controllers;

use App\Mail\AccountMail;
use Illuminate\Support\Facades\Mail;

use App\Models\Account;
use App\Models\Movie;
use App\Services\AccountGeneralService;
use App\Services\AdminService;
use App\Services\FileUploadService;
use App\Services\AuthenticationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Stmt\TryCatch;

class AdminController extends Controller
{
    protected $adminService;
    protected $fileUploadService;
    protected $authenticationService;
    protected $accountGeneralService;

    public function __construct(AdminService $admin_Service, FileUploadService $file_uploadService, AuthenticationService $authentication_Service, AccountGeneralService $accountGeneral_Service)
    {
        $this->adminService = $admin_Service;
        $this->fileUploadService = $file_uploadService;
        $this->authenticationService = $authentication_Service;
        $this->accountGeneralService = $accountGeneral_Service;

    }
    
    //function get genres
    public function getGenre(){
        try {
            $genres = $this->adminService->getAllGenre();
            return response()->json($genres,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()],500);
        }
    }
    //function get qualify of moive
    public function getQualify(){
        try {
            $qualify = $this->adminService->getAllQualification();
            return response()->json($qualify,200);
        } catch (\Throwable $th) {
            return response()->json(['error'=>$th->getMessage()],500);
        }
    }
    //function register new account administrator
    public function registerAdmin(Request $request){
        try {
            $validateData = $request->validate([
                'username' => 'required|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|min:6'
            ]);
            $validateData['role'] = 2;
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
    //edit information administrator
    public function editAdmin(Request $request,$id){
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
    //function change password administrator
    public function changePassword($id){
        try {
            $validate = [
                'password' => 'required|max255'
            ];
            $admin = $this->authenticationService->changePassword($validate,$id);
            return response()->json(['success'=>'change password success'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    // function forgot password for administrator
    public function forgotpasswordAdmin(Request $request){
        try {
            $validateData = [
                'password' => 'required|max:255'
            ];
            $admin = $this->authenticationService->findByEmail($request->input('email'))->first();
            if($admin!==null){
                $admins = $this->authenticationService->forgotPassword($validateData,$admin['id']);
                return response()->json(['success'=>'change password success']);
            }
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    //function delete account administrator
    public function deleteAdmin($id){
        try {
            $accounts = $this->accountGeneralService->deleteAccount($id);
            return response()->json(['success'=>'delete admin success'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    //function ban account user 
    public function banUser($id){
        try {
            $user = $this->adminService->banUser($id);
            return response()->json(['success'=>'change status success'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }


    
}
