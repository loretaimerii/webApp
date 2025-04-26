<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function createPost(Request $request){
        $incomingFields=$request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['body']=strip_tags($incomingFields['body']);
        $incomingFields['user_id']=auth()->id();

        Post::create($incomingFields);
        return redirect('/');
    }

    public function editPost(Post $post){
        //if you try to get access from the url to a post which is not yours, redirect it to the home page
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('edit-post',['post'=>$post]);
    }
    public function updatePost(Post $post,Request $request){
        if(auth()->user()->id !== $post['user_id']){
            return redirect('/');
        }

        $incomingFields=$request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        $incomingFields['title']=strip_tags($incomingFields['title']);
        $incomingFields['body']=strip_tags($incomingFields['body']);
        
        $post->update($incomingFields);
        return redirect('/myPosts');
    }
    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/myPosts');
    }
}
