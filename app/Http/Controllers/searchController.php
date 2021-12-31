<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class searchController extends Controller
{
    public function index(){
        //$users = DB::table('cars_details')->get();

        return view('welcome');
    }
    
    //Live Autocomplete Search
    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = DB::table('cars_details')->where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    }
    
    //fetch car records
    public function fetchCarRecord(Request $request)
    {
        $name = $request->input('name');
        $fetchRecord = DB::table('cars_details')->select('*')->where('name', 'like', $name)->get();
        $carData['data'] = $fetchRecord;
        return response()->json($carData);
     
  }
    } 

