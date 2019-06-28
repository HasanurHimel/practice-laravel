<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Session;

class DashboardController extends Controller
{
   public function showDashboard(){

       $data=[];
       $data['time']="time('y m d h m s')";
       $data['links']=[
           "Facebook"=>"https://facebook.com",
           "Twitter"=>"https://twitter.com",
           "Linkedin"=>"https://linkedin.com",
           "Google"=>"https://google.com",
       ];




       $data['user']=auth()->user();




       return view('Backend.dashboard', $data);

   }
}
