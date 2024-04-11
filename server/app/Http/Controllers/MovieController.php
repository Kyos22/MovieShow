<?php

namespace App\Http\Controllers;


use App\Models\Account;
use App\Models\Movie;
use App\Services\AdminService;
use App\Services\FileUploadService;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpParser\Node\Stmt\TryCatch;

class MovieController extends Controller
{
    protected $adminService;
    protected $fileUploadService;
    protected $movieService;

    public function __construct(AdminService $admin_Service,MovieService $movie_Service, FileUploadService $file_uploadService)
    {
        $this->adminService = $admin_Service;
        $this->fileUploadService = $file_uploadService;
        $this->movieService = $movie_Service;
    }
    //function create new movie
    public function addMovie(Request $request){
        $path = './images';
        $pathVideo = './videos';
        $photoDetail = null;
        $photoThumbnail = null;
        $video = null;

        try {
            $validate = $request->validate([
                'nameMovie'=>'required|max:255',
                'discription'=>'required|max:1000',
                'releaseYear'=>'numeric | after_or_equal:1945|before_or_equal:' .date('Y'),
                'runningTime'=>'numeric',
                'qualification' => 'numeric',
                'limitedAge'=>'numeric|between:1,17',
                'countries'=>'max:255',
                'genre'=>'numeric',
                'photoDetail'=>'max:255',
                'photoThumbnail'=>'max:255',
                'type'=>'max:255',
                'video'=>'required',
                'trailer'=>'max:255',
                'isAdmin'=>'numeric',
            ]);
            
            if($request->hasFile('photoThumbnail')){
                
                $photoDetail = $this->fileUploadService->uploadFileImage($request->file('photoThumbnail'),$path);
            }
            if($request->hasFile('photoDetail')){
                
                $photoThumbnail = $this->fileUploadService->uploadFileImage($request->file('photoDetail'),$path);
            }
            if($request->hasFile('video')){
                
                $video = $this->fileUploadService->uploadFileVideo($request->file('video'),$pathVideo);
            }
            $movieData = array_merge($validate,[
                'photoDetail' => $photoDetail,
                'photoThumbnail' => $photoThumbnail,
                'video'=>$video
            ]);
                      
            $movies = $this->movieService->addMovie($movieData);
            return response()->json($movies,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function get all Movie
    public function getMovie(){
        try {
            $movies = $this->movieService->getMovie();
            return response()->json($movies,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function delete Movie
    public function deleteMovie($id){
        try {
            $movies = $this->movieService->deleteMovie($id);
            return response()->json(['success'=>'delete movie success'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    //function modify Movie
    public function editMovie(Request $request,$id){
        $path = './images';
        $pathVideo = './videos';
        $photoDetail = null;
        $photoThumbnail = null;
        $video = null;

        try {
            $validate = $request->validate([
                'nameMovie'=>'max:255',
                'discription'=>'max:1000',
                'releaseYear'=>'numeric | after_or_equal:1945|before_or_equal:' .date('Y'),
                'runningTime'=>'numeric',
                'qualification' => 'numeric',
                'limitedAge'=>'numeric|between:1,17',
                'countries'=>'max:255',
                'genre'=>'numeric',
                'photoDetail'=>'max:255',
                'photoThumbnail'=>'max:255',
                'type'=>'max:255',
                'video'=>'',
                'trailer'=>'max:255',
                'isAdmin'=>'numeric',
            ]);
            
            if($request->hasFile('photoThumbnail')){
                
                $photoDetail = $this->fileUploadService->uploadFileImage($request->file('photoThumbnail'),$path);
            }
            if($request->hasFile('photoDetail')){
                
                $photoThumbnail = $this->fileUploadService->uploadFileImage($request->file('photoDetail'),$path);
            }
            if($request->hasFile('video')){
                
                $video = $this->fileUploadService->uploadFileVideo($request->file('video'),$pathVideo);
            }
            $movieData = array_merge($validate,[
                'photoDetail' => $photoDetail,
                'photoThumbnail' => $photoThumbnail,
                'video'=>$video
            ]);
                      
            $movies = $this->movieService->editMovie($movieData,$id);
            return response()->json($movies,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function change status movie
    public function changeStatus($id){
        try {
            $movie = $this->movieService->changeStatus($id);
            return response()->json(['success'=>'change status success'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function show detail movie
    public function showDetailMovie($id){
        try {
            $movies = $this->movieService->findMovieById($id);
            return response()->json($movies,200);
        } catch (\Throwable $th) {
             return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function show new movie by created
    public function showMovieCreated(){
        try {
            $movies = $this->movieService->ShowMovieByCreated();
            return response()->json($movies,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    //find movie by keyword searching
    public function findByKeyword(Request $request){
        try {
            $movies = $this->movieService->findByKeyword($request->input('nameMovie'));
            return response()->json($movies,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }

    
}
