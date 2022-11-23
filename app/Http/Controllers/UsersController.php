<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Menu;
use App\Models\State;
use App\Models\District;
use App\Models\RegisteringUser;
use App\Models\Otp;
use App\Helper\Common;
use Illuminate\Support\Facades\Hash;
use App\Models\Trainer;
use App\Models\ServiceEnquiry;
use App\Models\ProductsEnquiry;
use App\Models\EventsEnquiry;
use App\User;
use Auth;
use DB;
use Mail;
use Illuminate\Support\Facades\Cache;


Class UsersController extends Controller{
    public function __construct()
    {
        
    }
    // This function load the search page

    public function index(){
      try{
          return view('users.index');
      }catch (Exception $e){
            report($e);
            return false;
        } 
    }
    //For Desktop
    // This function using for get the details from api
    public function search(Request $request){
      try{
          $data=$request->all();
          $q=trim($data['qsearch']);
          
          if(Cache::has($q)){
            $response = Cache::get($q);
          }else{
            $apikey='308c9e4a50ee755c9f19aa80c7e3f927';
            $url = "https://gnews.io/api/v4/search?q=$q&token=$apikey&lang=en&country=us&max=50";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            
            Cache::put($q,$response,600);

          }
          return view('users.search_data',['response'=>$response]);
     
      }catch (Exception $e){
            report($e);
            return false;
        } 
    }
    // for providing in json format
    // This function using for get the details from api
    public function jsonSearchData(Request $request){
      try{
          $data=$request->all();
          $q=trim($data['qsearch']);
          
          if(Cache::has($q)){
            $response = Cache::get($q);
          }else{
            $apikey='308c9e4a50ee755c9f19aa80c7e3f927';
            $url = "https://gnews.io/api/v4/search?q=$q&token=$apikey&lang=en&country=us&max=50";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = json_decode(curl_exec($ch),true);
            curl_close($ch);
            
            Cache::put($q,$response,600);

          }
          return response()->json($response, 200);
          
      }catch (Exception $e){
            report($e);
            return false;
        } 
    }

    
}
