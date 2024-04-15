<?php

namespace App\Http\Controllers;

use App\Service\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $countryService;
    public function __construct(CountryService $country_Service){
        $this->countryService = $country_Service;
    }
    //function to add new country
    public function addCountry(Request $request){
        try {
            $validate = $request->validate([
                'nameCountry' => 'required|max:255'
            ]);
            $countries = $this->countryService->addNewCountry($validate);
            return response()->json($countries,200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //function to gett list country
    public function getCountry(){
        try {
            $countries = $this->countryService->getCountry();
            return response()->json($countries,200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
    //the same as with edit 
    //the same as with delete 

}
