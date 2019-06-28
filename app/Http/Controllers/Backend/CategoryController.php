<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use mysql_xdevapi\Session;
use Validator;

class CategoryController extends Controller
{
    public function index(){
        User::


        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];

        $data['categories']=Category::select('id', 'name', 'slug' ,'status')->orderBy('id', 'DESC')->simplepaginate(5);


        return view('Backend.index', $data);
    }

    public function create(){
        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];
        return view('Backend.create', $data);
    }

        public function store(Request $request){

//        return $request->all();

        $validator=Validator::make($request->all(),[
            'name'=>'required|min: 5|unique:categories',
            'status'=>'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Category::create([
           'name'=>trim($request->input('name') ),
           'slug'=>str_slug(trim($request->input('name'))),
           'status'=>$request->input('status'),
        ]);
        session()->flash('message', 'Category Updated Successfully..!!');
        return redirect()->route('categories.create');



    }




    public function show($id){
        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];

       $data['category']=Category::with('posts','posts.user')->find($id);



        return view('Backend.show', $data);
    }
    public function edit($id){
        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];

       $data['category']=Category::select('id','name', 'slug', 'status')->find($id);



        return view('Backend.edit', $data);
    }

    public function update($id, Request $request){

        $category =Category::find($id);

        $validate = Validator::make($request->all(), [
            'name'=>'required|min: 5|unique:categories,name,'.$category->id,
            'status'=>'required',
        ]);
        if ($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }


        $category->name = trim($request->name);
        $category->slug = str_slug(trim($request->name));
        $category->status = $request->status;
        $category->save();



        session()->flash('message', 'Category updated');

        return redirect()->back();

    }

    public function delete($id){
        $category =Category::find($id);
        $category->delete();
        session()->flash('message', 'Category Delete Successfully done..!');
        return redirect()->route('categories.index');

    }


}
