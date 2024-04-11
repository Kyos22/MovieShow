<?php
namespace App\Services;

use App\Models\Account;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Qualify;

class AdminService{
    //add movie
    public function addMovie(array $movieData){       
        $movies = Movie::create($movieData);
        return $movies;
    }
    //get all genre
    public function getAllGenre(){
        return Genre::all();
    }
    //get all qualification
    public function getAllQualification(){
        return Qualify::all();
    }
    //ban user
    public function banUser(int $id){
        $account = Account::find($id);
        if($account){
            $account->status = !$account->status;
            $account->save();
            return $account;
        }
        return null;
    }
   
}

?>