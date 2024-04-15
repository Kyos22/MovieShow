<?php
namespace App\Service;
use App\Models\Country;

class CountryService{
    //add new country
    public function addNewCountry(array $datas){
        $countries = Country::create($datas);
        return $countries;
    }
    //get list country
    public function getCountry(){
        $countries = Country::all();
        return $countries;
    }
}

?>