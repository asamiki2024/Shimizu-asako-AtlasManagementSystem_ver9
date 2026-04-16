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
        // キャンセル画面のモーダルで予約日時と部数のデータを表示させる為の変数
        $settings =ReserveSettings::with('users')->get();
        return view('authenticated.calendar.general.calendar', compact('calendar','settings'));
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
    public function delete($reserve_setting_id){
        $reserve_setting = reserve_settings::with('user', 'reserve_setting_users')->findOrFail($reserve_setting_id);
        $reserve_setting->delete();
        return redirect()->route('calender.show');
    }
}
