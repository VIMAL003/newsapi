<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

Class UsersController extends Controller{
    
    public function index(){
      try{
          return view('users.index');
      }catch (\Exception $e){
          log($e->getMessage());
          return false;
      } 
    }

    //For Desktop
    // This function using for get the details from api
    public function desktopGNewsData(Request $request){
      try{
          $data=$request->all();
          $q=trim($data['qsearch']);
          
          
            $apikey=env('GNEWS_API_KEY');
            $gnewsURL=env('GNEWS_URL');
            $url = $gnewsURL."/search?q=$q&token=$apikey&lang=en&country=us&max=50";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {     
              $error_msg = curl_error($ch); 
              log($error_msg);
            } 
            curl_close($ch);
            
            
          return view('users.search_data',['response'=>$response]);
     
      }catch (\Exception $e){
          log($e->getMessage());
          return false;
      } 
    }

    // for providing in json format
    // This function using for get the details from api
    public function getGnewsData(Request $request){
        try{
        
          $data=$request->all();
          $q=trim($data['qsearch']);
         
          if(Cache::has($q)){
            $response = Cache::get($q);
          }else{
            $apikey=env('GNEWS_API_KEY');
            $gnewsURL=env('GNEWS_URL');
            $url = $gnewsURL."/search?q=$q&token=$apikey&lang=en&country=us&max=50";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = json_decode(curl_exec($ch),true);
            if (curl_errno($ch)) {     
              $error_msg = curl_error($ch); 
              echo $error_msg; exit;
            } 
            curl_close($ch);
            
            Cache::put($q,$response,600);

          }
          return response()->json($response, 200);
          
        }catch (\Exception $e){
            log($e->getMessage());
            return false;
        } 
    }

    
}
