<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\controller;
use App\Notifications\notifyEmail;
use App\Mail\verificationEmail;
use App\Notifications\notifyAdmin;

//use App\Jobs\varifyEmail;
use App\Post;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use App\User;
use Cache;
use Mail;
use Session;
use Queue;
use BB;








use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){

        $data=[];
        $data['time']="date(Y-m-d h:i:sa)";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];


        $data['posts']= cache('posts', function(){
           Post::select('id', 'title', 'user_id', 'category_id', 'created_at')->orderBy('id', 'DESC')->take(50)->get();
        });






        return view('test',$data);
    }


    public function post(){

        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];

        return view('posts', $data );
    }

    public function RegistrationForm(){
        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];
        return view('register',$data);
    }

    public function ProccessRegistration(Request $request){




        $validator= Validator::make($request->all(), [
           'email' => 'required|email|unique:users',
           'userName' => 'required|unique:users|min: 5',
           'password'=>'required|min:6',
           'photo'=>'required|image|max:100000|filled',

        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photo= $request->file('photo');

        //this is for uniq name
       $file_name=uniqid('photo_', true).str_random(10).'.'.$photo->getClientOriginalName();

       if ($photo->isValid()) {
           $photo->storeAs('images', $file_name);

       }


           $user = User::create([
               'email' => strtolower(trim($request->input('email'))),
               'userName' => trim($request->input('userName')),
               'password' => bcrypt($request->input('password')),
               'photo' => $file_name,
               'email_varified_token' => str_random(32)

           ]);



//        Mail::to($user->email)->send(new VerificationEmail($user));



      $user->notify(new notifyEmail($user));


//        $admin=User::find(10);
//        $admin->notify(new notifyAdmin($user));


           session()->flash('message', 'Registration successfully done');
           return redirect()->back();


    }


    public function verify($token){



        if ($token == null){
            session()->flash('message', 'you have to email varified first ..!! ');
            return redirect()->route('login');
        }

        $user =User::where('email_varified_token', $token)->first();
        if ($user ==null){
            session()->flash('message', 'invalid token ..!! ');
            return redirect()->route('login');
        }

        $user->update([

           'email_varified'=>1,
           'email_varified_at'=>Carbon::now(),
           'email_varified_token'=>''
        ]);


        session()->flash('message', 'Thanks for Varifying your email and stay with us');
        return redirect()->route('login');

   }






    public function ShowLoginForm(){

        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];
        return view('login', $data);
    }
    public function ProccessLogin(Request $request){

        $validator= Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',


        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }



        $inputs= $request->except('_token');





        if (Auth::attempt($inputs)){


            $user=auth()->user();
            if ($user->email_varified ==0){
                session()->flash('message', 'you email has not varified please varified your email');
                return redirect()->route('login');
            }
            $user->last_login =Carbon::now();
            $user->save();
            session()->flash('message', 'you are logged in');
            return redirect()->route('dashboard');


        }
        else{
            session()->flash('message', 'Please input your valid email or password.. !!');
            return redirect()->back();
        }



    }

    public function logout(){
        Auth::logout();
        session()->flash('message', 'You have been logged out');
        return redirect()->route('login');
    }





}
