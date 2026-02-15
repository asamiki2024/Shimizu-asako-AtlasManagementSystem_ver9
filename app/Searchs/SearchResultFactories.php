<?php
namespace App\Searchs;

use App\Models\Users\User;

class SearchResultFactories{

  // 改修課題：選択科目の検索機能
  public function initializeUsers($keyword, $category, $updown, $gender, $role, $subjects, $subjectIDs){
    if($category == 'name'){
      if(is_null($subjects)){
        $searchResults = new SelectNames();
      }else{
        $searchResults = new SelectNameDetails();
      }
      return $searchResults->resultUsers($keyword, $category, $updown, $gender, $role, $subjects, $subjectIDs);
    }else if($category == 'id'){
      if(is_null($subjects)){
        $searchResults = new SelectIds();
      }else{
        $searchResults = new SelectIdDetails();
      }
      return $searchResults->resultUsers($keyword, $category, $updown, $gender, $role, $subjects, $subjectIDs);
    }else{
      // 追記
      // $subjectIDs = $request->input('subject',[]);
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
      $allUsers = new AllUsers();
    return $allUsers->resultUsers($keyword, $category, $updown, $gender, $role, $subjects, $subjectIDs);
    }
  }
}