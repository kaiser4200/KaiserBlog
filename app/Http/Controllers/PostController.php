<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg,gif,svg'
        ]);
        if($request->image)
        {
            $imageName = time().'.'.request()->image->getClientOriginalExtension();
            request()->image->move(public_path('image/blog_post'),$imageName);
            $imageName ='image/blog_post/'.$imageName;
        }
        $post = new Post();
        $post->user_id=Auth::user()->id;
        $post->title = $request->title;
        $post->description = $request->description;
        //($request->image) ? $post->image = $imageName : null;
        if($request->image)
            $post->image=$imageName;
        $saved = $post->save();

        return $saved
            ? back()->with('success','you have successfully added post.')
            : back()->with('error','Something went wrong');
    }

        // The blog post is valid...


        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('showPost',compact('post'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editpost = Post::find($id);
        return  view('editPost',compact('editpost'));

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
        $post = Post::find($id);

        $post->title = $request->edittitle;
        $post->description = $request->editdescription;

        if($request->hasFile('image')) {
            unlink(public_path($post->image));
            $image = $request->file('image');
            $filename = time().'.'.request()->image->getClientOriginalName();
            $image->move(public_path('image/blog_post'), $filename);
            $filename ='image/blog_post/'.$filename;
            $post->image = $filename;
        }

        $updated = $post->update();

        return $updated
            ? redirect()->route("home")->with('success','You have successfully updated your post.')
            : back()->with('error','Something went wrong');

//        $request->validate([
//            'edittitle' => 'required',
//            'editdescription' => 'required',
//            'image' => 'mimes:jpeg,bmp,png,jpg,gif,svg',
//        ]);
//
//        $updated_image=Null;
//
//        if($request->image)
//        {
//            $imageName = time().'.'.request()->image->getClientOriginalExtension();
//            request()->image->move(public_path('image/blog_post'),$imageName);
//            $imageName ='image/blog_post/'.$imageName;
//
//            $updated_image = Post::where('id',$id)->update(['image' =>$imageName]);
//        }
//
//
//
//        $updated = Post::where('id',$id)->update(['title' =>$request ->edittitle,'description'=>$request->editdescription]);
//
//        return $updated
//            ?$updated_image
//                ? redirect()->route('home')->with('success','Post has been updated successfully with image')
//                :redirect()->route('home')->with('success','Post has been updated successfully without image')
//            : back()->with('error','something went wrong');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);


        $path = 'image/blog_post/';
        $image_name = explode('/',$post->image);
        //dd($post);
        $image_name = $image_name[2];

        if(strcmp($image_name,'default_blog_img'))
            unlink(public_path($post->image));

        $deleted = $post->delete();

        return $deleted
            ? redirect()->route("home")->with('success','You have successfully deleted your post.')
            : back()->with('error','Something went wrong');

    }

//    public function img_delete(Request $request)
//    {
//        $post_id = $request->id;
//        $post = Post::findOrFail($post_id);
//
//
//        if($post->image==='image/blog_post/default_blog_img/default.jpg')
//        {
//            return back()->with('error','default image cannot be deleted');
//
//        }
//        else
//        {
//            unlink(public_path($post->image));
//            $post->update(['image'=>'image/blog_post/default_blog_img/default.jpg']);
//
//            return redirect()->route('home')->with('success','Image has been set to default');
//        }
//
//
//    }
}
