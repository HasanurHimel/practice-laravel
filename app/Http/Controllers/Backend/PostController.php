<?php

namespace App\Http\Controllers\Backend;
use App\User;
use Auth;
use App\Category;
use App\Post;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Storage;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];

       $data['posts']=Post::with('category','user')->select( 'id','user_id', 'category_id', 'title','content','image_path', 'status')->orderBy('id', 'DESC')->paginate(10);
        return view('Backend.posts.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];
        $data['categories']= Category::select('id', 'name')->get();


        return view('Backend.posts.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(), [
            'category_id' => 'required',
            'title'=>'required|min: 5|unique:posts',
            'longText'=>'required|min: 10',
            'photo'=>'required|image',
            'status'=>'required'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $photo=$request->file('photo');
        $imageUrl = Storage::putFile('images/',$photo );


        $user =Auth::user()->id;

        $post=new Post;
        $post->user_id = $user;
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->content = $request->longText;
        $post->image_path = $imageUrl;
        $post->status = $request->status;
        $post->save();


        session()->flash('message', 'post uploaded successfully..!!');
        return redirect()->back();



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];

        $data['posts']=Post::with('user', 'category')->find($id);

        return view('Backend.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=[];
        $data['time']="time('y m d h m s')";
        $data['links']=[
            "Facebook"=>"https://facebook.com",
            "Twitter"=>"https://twitter.com",
            "Linkedin"=>"https://linkedin.com",
            "Google"=>"https://google.com",
        ];
        $data['posts']=Post::select('id', 'category_id', 'title', 'content', 'image_path', 'status')->find($id);

        $data['categories']=Category::all();

        return view('Backend.posts.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator=Validator::make($request->all(), [
            'category_id' => 'required',
            'title'=>'required|min: 5|unique:posts,title,'.$id,
            'longText'=>'required|min: 10',
            'image_path'=>'image',
            'status'=>'required'
        ]);

        if ($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

//        $photo=$request->file('photo');

        $post=Post::find($id);

        $imageUrl=$post->image_path;

        if ($request->hasFile('photo')){

            $imageUrl =Storage::putFile('images/',$request->file('photo') );
            unlink('uploads/'.$post->image_path);

        }


        $user =Auth::user()->id;

        $post->update([
           'user_id'=> $user,
            'category_id'=>$request->category_id,
            'title'=>trim($request->title),
            'content'=>$request->longText,
            'image_path'=>$imageUrl,
            'status'=>$request->status
        ]);


        session()->flash('message', 'post updated successfully..!!');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $post=Post::find($id);
       $post->delete();
       session()->flash('message', 'post deleted successfully..!!');
       return redirect()->route('posts.index');
    }
}
