<?php

namespace App\Http\Controllers;

use App\Models\rc;
use App\Models\Scategory;
use App\Models\Spost;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;


//changed from manual gates defnition in authprovider to policy
class SPostController extends Controller
{
    public function index()
    {
        // $posts = Cache::rememberForever('posts', function () {
        //             return Spost::with('scategory')->paginate(5);
        // });
        $posts = Cache::remember('posts-page-'.request('page',1),60*3,function(){
            return Spost::with('scategory')->paginate(5);
});
        return view('index',compact('posts'));
    }
    /**
     *
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',Spost::class);

        $categories = Scategory::all();
        return view('create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create',Spost::class);
        $request->validate([
            'image'=>['required','image'],
            'title'=>['required','max:255'],
            'scategory_id'=>['required','integer'],
            'description'=>['required']

        ]);

        $fileName=time().'_'.$request->image->getClientOriginalName();
        $filePath=$request->image->storeAs('uploads',$fileName);
        $post= new Spost;
        $post->title=$request->title;
        $post->description=$request->description;
        $post->scategory_id=$request->scategory_id;
        $post->image ='storage/'.$filePath;
        $post->save();
        return redirect()->route('spost.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post= Spost::findOrfail($id);

        return view('show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post= Spost::findOrfail($id);
        $this->authorize('update',$post);
            $categories=Scategory::all();

           return view('edit',compact('post','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post= Spost::findOrfail($id);
        $this->authorize('update',$post);
        $request->validate([
            // 'image'=>['required','image'],
            'title'=>['required','max:255'],
            'scategory_id'=>['required','integer'],
            'description'=>['required']

        ]);

        if($request->hasFile('image')){
            $request->validate([
                'image'=>['required','image'],
            ]);
            $fileName=time().'_'.$request->image->getClientOriginalName();
            $filePath=$request->image->storeAs('uploads',$fileName);
            File::delete(public_path($post->image));
            $post->image ='storage/'.$filePath;
        }



        $post->title=$request->title;
        $post->description=$request->description;
        $post->scategory_id=$request->scategory_id;


        $post->update();
        return redirect()->route('spost.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post= Spost::findOrfail($id);
        $this->authorize('delete',$post);

        $post->delete();
        return redirect()->route('spost.index');

    }


    public function trashed (){
        $this->authorize('delete_post');

        $posts = Spost::onlyTrashed()->get();
        return view('trashed',compact('posts'));
    }

    public function restore($id){
        $this->authorize('delete_post');

     $post=Spost::onlyTrashed()->findOrFail($id);
     $post->restore();
     return redirect()->route('spost.index');
    }


    public function forceDelete($id){
        $this->authorize('delete',Spost::class);

        $post=Spost::onlyTrashed()->findOrFail($id);
        File::delete(public_path($post->image));
        $post->forceDelete();
        return redirect()->back();
       }



}
