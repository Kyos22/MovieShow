<?php

namespace App\Http\Controllers;

use App\Services\PackageService;
use Illuminate\Http\Request;


class PackageController extends Controller
{
    protected $packageService;

    public function __construct(PackageService $package_Service){
        $this->packageService = $package_Service;
    }
    //create new package
    public function addPackage(Request $request){
        try {
            $validateData = $request->validate([
                'namePackage' => 'string',
                'pricePerMonth' => 'required',
                'flixTVOriginals'=>'nullable|boolean',
                'flexiblePlan'=>'nullable|boolean',
                'streamLive'=>'nullable|boolean',
                'tvChannels'=>'nullable|boolean'
                ]);
            

            $package = $this->packageService->addPackage($validateData);
            return response()->json($package,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function get package
    public function getPackage(){
        try {
            $packages = $this -> packageService->getPackage();
            return response()->json($packages,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function delete package
    public function deletePackage($id){
        try {
            $package = $this->packageService->deletePackage($id);
            return response()->json(['success'=>'delete package success'],200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function edit package
    public function editPackage(Request $request, $id){
        try {
            $validateData = $request->validate([
                'namePackage' => 'string',
                'pricePerMonth' => 'required',
                'flixTVOriginals'=>'nullable|boolean',
                'flexiblePlan'=>'nullable|boolean',
                'streamLive'=>'nullable|boolean',
                'tvChannels'=>'nullable|boolean'
                ]);
            $package = $this->packageService->editPackage($validateData,$id);
            return response()->json($package,200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
}
