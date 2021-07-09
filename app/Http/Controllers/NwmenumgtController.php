<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NwmenumgtController extends Controller{

    function index(){

        if(Auth::user()->level == 9) {
            return redirect('/');
        }


        $data = array(
            'list' => DB::select("SELECT *, (SELECT COUNT(1) FROM users WHERE TB_MENU.MENU_ID = users.storelevel AND users.enabled = 1) AS CNT1 FROM TB_MENU")
        );

        return view('menumgt.index', $data);
    }


    function menumgtadd(Request $request){

        $tmpselectmenu = $request->input('selectmenu');
        $menuarr = explode("|",$tmpselectmenu);
        $newmenuarr = "";
        $cnt = 0;
        foreach ($menuarr as $menus){
            if($menus != "undefined"){
                if($cnt == 0){
                    $newmenuarr = $menus;
                }else{
                    $newmenuarr = $newmenuarr."|".$menus;
                }
                $cnt++;
            }

        }

        $query = DB::table('TB_MENU')->insert([
            'MENU_NAME'=>$request->input('menulevel'),
            'MENU_ARR'=>$newmenuarr,
            'ACTIVEFLAG'=>$request->input('ap_activeflag'),
            'UPD_ID'=>Auth::user()->user_id,
            'UPD_DT'=>date('Y-m-d H:i:s')
        ]);

        if($query){
            return redirect('/nwmenumgt')->with('status', 'Yes');
        }else{
            return redirect('/nwmenumgt')->with('status', 'No');
        }

    }

    /*** Menu update  */
    function menumgtupdate(Request $request){

        $tmpselectmenu = $request->input('selectmenu');
        $menuarr = explode("|",$tmpselectmenu);
        $newmenuarr = "";
        $cnt = 0;
        foreach ($menuarr as $menus){
            if($menus != "undefined"){
                if($cnt == 0){
                    $newmenuarr = $menus;
                }else{
                    $newmenuarr = $newmenuarr."|".$menus;
                }
                $cnt++;
            }

        }

        $updateing = DB::table('TB_MENU')
            ->where('MENU_ID', $request->input('seq'))
            ->update([
                'MENU_NAME'=>$request->input('menulevel'),
                'MENU_ARR'=>$newmenuarr,
                'ACTIVEFLAG'=>$request->input('ap_activeflag'),
                'UPD_ID'=>Auth::user()->user_id,
                'UPD_DT'=>date('Y-m-d H:i:s')
            ]);

        return redirect('nwmenumgt');
    }

    /*** Menu delete  */
    function menumgtdel(Request $request){
        $delete = DB::table('TB_MENU')
            ->where('MENU_ID', $request->input('seq'))
            ->delete();

        if($delete){
            return back()->with('success','삭제 되었습니다.');
        }else{
            return back()->with('fail','삭제관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }
    }

}




