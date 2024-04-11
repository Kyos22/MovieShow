<?php
namespace App\Services;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Qualify;

class MovieService{
    //add movie
    public function addMovie(array $movieData){  
        $movies = Movie::create($movieData);
        return $movies;
    }
    //get movie
    public function getMovie(){
        $movies = Movie::all();
        return $movies;
    }
    //delete movie
    public function deleteMovie(int $movieData){
        $movies = Movie::find($movieData);
        $movies->delete();
        return $movies;
    }
    //Modify moive
    public function editMovie(array $movieData, int $id) {
        $movie = Movie::find($id);
        if (!$movie) {
            return null; 
        }
        foreach ($movieData as $key => $value) {
            if ($value !== null) { 
                $movie->$key = $value;
            }
        }
        $movie->save();
        return $movie;  
    }
    //change status of movie, hide or show movie
    public function changeStatus(int $id){
        $movies = Movie::find($id);
        if($movies){
            $movies->status = !$movies->status;
            $movies->save();
            return $movies;
        }else{
            return null;
        }
    }
    //find movie by id 
    public function findMovieById(int $id){
        $movies = Movie::find($id);
        if($movies){
            return $movies;
        }else{
            return null;
        }
    }
    //get movie by created, arrange list movie asc
    public function ShowMovieByCreated(){
        $movies = Movie::orderBy('releaseYear','desc')->get();
        return $movies;
    }
    //find Movie by keyword
    public function findByKeyword(string $keyword){
        $movies = Movie::where('nameMovie','like','%'.$keyword.'%')->get();
        return $movies;
    }

}

?>