<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

Use App\Models\User;
Use App\Models\User_location;
Use App\Models\User_detail;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function getData(Request $request)
    {
        $userModel=new User; 
        $usDetailModel=new User_detail; 
        $usLocModel=new User_location; 
        

        $response = Http::get('https://randomuser.me/api');

        $rs = $response->json();
        $data=$rs['results'][0];

        $name=$data['name']['title'].' '.$data['name']['first'].' '.$data['name']['last'];
        $email=$data['email'];
        $gender=$data['gender'];
        $city=$data['location']['city'];
        $country=$data['location']['country'];
         
        $request->merge([
            'name' => $name,  
            'email' => $email,  
            'gender' => $gender,  
            'city' => $city,  
            'country' => $country,  
        ]);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);
        
        if (!$validator->fails()) {

            $data2=array(
            'name'=>$request->name ,
            'email'=>$request->email ,
            'password'=>rand(2,5) ,
            ) ;
        
              // print_r($data2)     ;
            $newInfo = $userModel->create($data2);
            
            $data3=array(
                'userId'=>$newInfo->id ,
                'gender'=>$request->gender ,
               
                ) ;
                $usDetailModel->create($data3);

            $data4=array(
                'userId'=>$newInfo->id ,
                'city'=>$request->city ,
                'country'=>$request->country ,
                
                ) ;
        
                $usLocModel->create($data4);

        }

        if ($request->expectsJson()) 
        {
            return response()->json([
                'message' => 'Data saved successfully.',
                'data' => $newInfo
            ], 201);
        }
        
       
    }

    public function searchData(Request $request)
    {
        DB::enableQueryLog();
       // print_r($request->gender);dd();
        if(!isset($request->limit))
        {
            $request->merge([
                'limit' => 10, 
                //'gender'=>'male' 
             ]);
        }
       
        //print_r($request->all());dd();

        $result = DB::table('users as u')
        ->leftJoin('user_detail as ud', 'ud.userId', '=', 'u.id')
        ->leftJoin('user_location as ul', 'ul.userId', '=', 'u.id')
         ->addSelect('u.name as name','u.email as email','ud.gender as gender','ul.city as city','ul.country as country')
         
             ->when(filled($request->gender), function ($query) use ($request) {
                $query->where('ud.gender', "$request->gender");
            })

            ->when(filled($request->city), function ($query) use ($request) {
                $query->where('ul.city', 'like', "%$request->city%");
            })

            ->when(filled($request->country), function ($query) use ($request) {
                $query->where('ul.country', 'like', "%$request->country%");
            })

        

         //->orderBy("$req->sort_value", "$req->sort_order")
        ->paginate(
            $perPage = $request->limit, $columns = ['*'], $pageName = 'admin'
        );
         
        // dd(DB::getQueryLog());

       // return response()->json($query->paginate(10));
       return response()->json($result);
    }

    //php artisan make:command CheckTask
    //php artisan schedule:work
}
