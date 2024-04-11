<?php
namespace App\Services;

use App\Models\Account;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Qualify;

class AccountGeneralService{
    
    public function editAccount(array $adminData, $id){
        $account = Account::find($id);
        if(!$account){
            return null;

        }
        foreach($adminData as $key => $value){
            if($value!==null){
                $account->$key = $value;
            }
        }
        $account -> save();
        return $account;
    }
    public function deleteAccount(int $id){
        $accounts = Account::find($id);
        $accounts -> delete();
        return $accounts;
    }
}

?>