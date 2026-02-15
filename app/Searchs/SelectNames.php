<?php
namespace App\Searchs;

use App\Models\Users\User;

class SelectNames implements DisplayUsers{

  public function resultUsers($keyword, $category, $updown, $gender, $role, $subjects, $subjectIDs){
    if(empty($gender)){
      $gender = ['1', '2', '3'];
    }else{
      $gender = array($gender);
    }
    if(empty($role)){
      $role = ['1', '2', '3', '4'];
    }else{
      $role = array($role);
    }
    // 追記
    // $subjectIDs = $resultUsers->input('subject',[]);
        // name="subject[]"が中に入る。
    $query = User::query()->with('subjects');
  
    if(!empty($subjectIDs)){
            $query->whereHas('subjects', function ($q) use ($subjectIDs){
                $q->whereIn('subjects.id', $subjectIDs);
            });
    }
    if(!empty($keyword)){
        $query->where(function($q) use ($keyword){
          $q->where('over_name', 'like', '%'.$keyword.'%')
          ->orWhere('under_name', 'like', '%'.$keyword.'%')
          ->orWhere('over_name_kana', 'like', '%'.$keyword.'%')
          ->orWhere('under_name_kana', 'like', '%'.$keyword.'%');
        });
    }

    $users = User::with('subjects')
    ->where(function($q) use ($keyword){
      $q->where('over_name', 'like', '%'.$keyword.'%')
      ->orWhere('under_name', 'like', '%'.$keyword.'%')
      ->orWhere('over_name_kana', 'like', '%'.$keyword.'%')
      ->orWhere('under_name_kana', 'like', '%'.$keyword.'%');
    })->whereIn('sex', $gender)
    ->whereIn('role', $role)
    ->orderBy('over_name_kana', $updown)->get();

    return $users;
  }
}
