<?php

namespace App\Services;

use App\Models\Account;

use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthenticationService{
    //service signup account for customer
    public function SignUp(array $userData){
        $userData['password'] = Hash::make($userData['password']);
        $userData['status'] = true;
        $userData['role'];
        $userData['idCountry'];
        $userData['created'] = Carbon::now();

        $user = Account::create($userData);
        return $user;
    }
    //service sign in account for both customer and administrator
    public function SignIn(array $userData){
        $user = Account::where('email',$userData['email'])->first();
        if($user && Hash::check($userData['password'],$user->password) && $user->role == 1 ){
            session(['user_id' => $user->id]);
            return ['user'=>$user,'role'=>$user->role];
        }else if($user && Hash::check($userData['password'],$user->password) && $user->role == 2){
            session(['user_id' => $user->id]);
            return ['user'=>$user,'role'=>$user->role];
        }
        return false;       
    }
    //service to find email through input
    public function findByEmail(string $email){
        $account = Account::where('email',$email)->first();
        if($account){
            return $account;
        }else{
            return null;
        }
        
    }
    //service forgot password client side
    public function forgotPassword(array $account, int $id){
            $accounts = Account::find($id);
            if(!$accounts){
                return null;
            }
            foreach($account as $key => $value){
                if($value!== null){
                    $accounts->$key = Hash::make($value);
                }
            }
            $accounts->save();
            return $accounts;
       
        return $accounts;
        
    }
    //service check email or username exist or not
    public function checkExistEmailUsername(string $username,string $email){
        // $account = Account::where('username',$username || 'email',$email);
        // if($account){
        //     return $account;
        // }else{
        //     return null;
        // }
        return Account::where('username',$username)->orwhere('email',$email)->exists();
    }
    //function change password for both user and admin
    public function changePassword(array $adminData,$id){
        $admin = Account::find($id);
        if(!$admin){
            return null;
        }
        foreach($adminData as $key => $value){
            if($value!==null){
                $admin->$key = $value;
            }
        }
        $admin->save();
        return $admin;
    }

}

?>