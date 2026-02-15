<?php

namespace App\Http\Controllers\Authenticated\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Gate;
use App\Models\Users\User;
use App\Models\Users\Subjects;
use App\Searchs\DisplayUsers;
use App\Searchs\SearchResultFactories;

class UsersController extends Controller
{

    public function showUsers(Request $request){
        $keyword = $request->keyword;
        $category = $request->category;
        $updown = $request->updown;
        $gender = $request->sex;
        $role = $request->role;
        $subjects = null;
        // 選択科目でユーザー検索
        $subjectIDs = $request->input('subject',[]);
        // dd($request->all());
        // name="subject[]"が中に入る。
        $query = User::query()->with('subjects');
        // 選択科目で絞り込み　どれか1つでも一致
        // if(!empty($subjectIDs)){
        //     // dd($subjectIDs);
        //     $query->whereHas('subjects', function ($q) use ($subjectIDs){
        //         $q->whereIn('subjects.id', $subjectIDs);
        //         // dd($query);
        //     });
        //     // dd([
        //     //     'sql' => $query->toSql(),
        //     //     'bindings' => $query->getBindings(),
        //     // ]);
        //     }
    

        $userFactory = new SearchResultFactories();
        $users = $userFactory->initializeUsers($keyword, $category, $updown, $gender, $role, $subjects, $subjectIDs);
        $subjects = Subjects::all();
        $users = $query->get();
        // dd($subjectIDs, $query->toSql(), $query->getBindings());
        return view('authenticated.users.search', compact('users', 'subjects'));
    }

    public function userProfile($id){
        $user = User::with('subjects')->findOrFail($id);
        $subject_lists = Subjects::all();
        return view('authenticated.users.profile', compact('user', 'subject_lists'));
    }

    public function userEdit(Request $request){
        $user = User::findOrFail($request->user_id);
        $user->subjects()->sync($request->subjects);
        return redirect()->route('user.profile', ['id' => $request->user_id]);
    }
}