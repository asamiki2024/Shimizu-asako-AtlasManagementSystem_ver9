<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        return view('authenticated.calendar.general.calendar', compact('calendar'));
    }

    public function reserve(Request $request){
        DB::beginTransaction();
        try{
            $getPart = $request->getPart;
            $getDate = $request->getData;
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

     // 予約キャンセル
    public function delete(Request $request){
        // DB::table('テーブル名')→データベースから直接テーブル名を指定して処理をする。
        // ->where('user_id(テーブルのカラム名)', auth()->id()(ユーザIDの情報))→
        // テーブルのユーザーidとUserテーブルのidが一致しているか確認している。
        // ->where('reserve_setting_id(カレンダー予約id)', $request->reserve_setting_id(予約のデータが入っているid))->delete();→
        // カレンダー予約idと予約データが入ったidが一致しているか、どちらも一致したものを削除する。
        DB::table('reserve_setting_users')->where('user_id', auth()->id())->where('reserve_setting_id', $request->reserve_setting_id)->delete();
        // 処理後に戻る時にuser_idも一緒に送ってあげる必要がある。38行目を参照。
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }
}
