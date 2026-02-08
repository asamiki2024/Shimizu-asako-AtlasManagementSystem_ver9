<?php

namespace App\Http\Controllers\Authenticated\BulletinBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories\MainCategory;
use App\Models\Categories\SubCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\Posts\Like;
use App\Models\Users\User;

use App\Http\Requests\BulletinBoard\PostFormRequest;
use Auth;

class PostsController extends Controller
{
    public function show(Request $request){
        $categories = MainCategory::get();
        // 追加
        $posts = Post::with('user', 'postComments')->get();
        $like = new Like;
        $post_comment = new Post;
        if(!empty($request->keyword)){
            // dd($posts);
            $sub = $request->keyword;
            $sub_category =SubCategory::where('sub_category', $sub)->first();
            // dd($sub_category);
        if(($sub_category)){
            $posts = $sub_category->post()->with('subCategories','user', 'postComments')
            // ->whereHas('subCategories', function ($q) use ($sub){
                // $q->where('sub_category', $sub);
            ->get();
            // dd($posts);
        }else{
            $posts = Post::with('user', 'postComments')
            ->whereHas('subCategories', function ($q) use ($sub){
                $q->where('sub_category', $sub);
            })->get();
        }
            $posts = Post::with('user', 'postComments')
            ->where('post_title', 'like', '%'.$request->keyword.'%')
            ->orWhere('post', 'like', '%'.$request->keyword.'%')->get();
        }else if($request->category_word){
            $sub_category = $request->category_word;
            $posts = Post::with('user', 'postComments')->get();
        // 追加　サブカテゴリーでの検索(完全一致)
        }else if(!empty($request->sub_category)){
            $sub = $request->sub_category;
            // dd($posts);
            $posts = Post::with('user', 'postComments')
            ->whereHas('subCategories', function ($q) use ($sub){
                $q->where('sub_category', $sub);
            })->get();

        }else if($request->like_posts){
            $likes = Auth::user()->likePostId()->get('like_post_id');
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->get();
        }else if($request->my_posts){
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())->get();
        }
        return view('authenticated.bulletinboard.posts', compact('posts', 'categories', 'like', 'post_comment'));
    }

    public function postDetail($post_id){
        $post = Post::with('user', 'postComments')->findOrFail($post_id);
        return view('authenticated.bulletinboard.post_detail', compact('post'));
    }

    public function postInput(){
        // メインカテゴリーとサブカテゴリーをブレードに表示させる
        $main_categories = MainCategory::with('subCategories')->orderBy('id')->get();
        return view('authenticated.bulletinboard.post_create', compact('main_categories'));
        // view('sub.category.create', compact('main_categories'));
    }

    public function postCreate(PostFormRequest $request){
        // dd($request->sub_category_id);
        $post = Post::create([
            'user_id' => Auth::id(),
            'post_title' => $request->post_title,
            'post' => $request->post_body
        ]);
        
        $post->subCategories()->attach($request->sub_category_id);
        return redirect()->route('post.show');
    }

    public function postEdit(Request $request){
        //編集時のバリデーション　追記
        $request->validate([
            'post_title' => 'required|string|max:100',
            'post_body' => 'required|string|max:2000',
        ]);
        Post::where('id', $request->post_id)->update([
            'post_title' => $request->post_title,
            'post' => $request->post_body,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function postDelete($id){
        Post::findOrFail($id)->delete();
        return redirect()->route('post.show');
    }
    //メインカテゴリー追加
    public function mainCategoryCreate(Request $request){
        //メインカテゴリーバリデーション
        //uniqueは、同じものを登録しない為、min_categoriesテーブルのカラムmin_category_nameを指定。
        // dd($request);
        $validated = $request->validate([
            'main_category_name' => 'required|string|max:100|unique:main_categories,main_category',
        ]);
        MainCategory::create([
            'main_category' => $validated['main_category_name'],
        ]);
        return redirect()->route('post.input');
    }
    //サブカテゴリーを追加 自分で追加
    // メインカテゴリーとサブカテゴリーの紐づけ登録
    public function SubCategoryCreate(Request $request){
        //サブカテゴリーのバリデーション
        //existsは、登録されている内容と同じものか判断。sub_categoriesテーブルのカラムmain_category_idを指定。
        //uniqueは、同じものを登録しない為、sub_categoriesテーブルのカラムsub_categoryを指定。
        // dd($request);
        $validated = $request->validate([
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
        ]);
        // dd($validated);
        SubCategory::create([
            'main_category_id' => $validated['main_category_id'],
            'sub_category' => $validated['sub_category_name'],
        ]);
        return redirect()->route('post.input');
    }
    // 投稿のコメント作成
    public function commentCreate(Request $request){
        // 投稿のコメントのバリデーション
        $request->validate([
            'comment' => 'required|string|max:250'
        ]);
        PostComment::create([
            'post_id' => $request->post_id,
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);
        return redirect()->route('post.detail', ['id' => $request->post_id]);
    }

    public function myBulletinBoard(){
        $posts = Auth::user()->posts()->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_myself', compact('posts', 'like'));
    }

    public function likeBulletinBoard(){
        $like_post_id = Like::with('users')->where('like_user_id', Auth::id())->get('like_post_id')->toArray();
        $posts = Post::with('user')->whereIn('id', $like_post_id)->get();
        $like = new Like;
        return view('authenticated.bulletinboard.post_like', compact('posts', 'like'));
    }
    // いいね機能の処理
    // いいねを付けた時に動く処理
    public function postLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->like_user_id = $user_id;
        $like->like_post_id = $post_id;
        $like->save();

        return response()->json();
    }
    // いいね解除する時に動く処理
    public function postUnLike(Request $request){
        $user_id = Auth::id();
        $post_id = $request->post_id;

        $like = new Like;

        $like->where('like_user_id', $user_id)
             ->where('like_post_id', $post_id)
             ->delete();

        return response()->json();
    }
}
