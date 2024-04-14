<?php
namespace App\Services;
use App\Models\Package;

class PackageService{
    // "2" : regular
    // "3" : premium
    // "4" : premium + tvchannel
    //create new package
    public function addPackage(array $package){
        $packages = Package::create($package);
        return $packages;
    }
    //get package
    public function getPackage(){
        $package = Package::all();
        return $package;
    }
    //delete package
    public function deletePackage($id){
        $package = Package::find($id);
        $package->delete();
        return $package;
    }
    //edit package
    public function editPackage(array $data ,int $id){
        $check = Package::find($id);
        if(!$check){
            return null;
        }  
            foreach($data as $key => $value){
                if($value!== null){
                    $check->$key = $value;
                }
            }
            $check->save();
            return $check;
            
        }
        
}

?>