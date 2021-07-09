<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpseclib3\Crypt\DSA\Formats\Keys\Raw;
use Illuminate\Support\Facades\Auth;


class NwgiftController extends Controller
{
    /*** Nanum gift list : 상품권 리스트 */
    function index(){
        $data = array(
            'list' => DB::table('tb_gift')->get()
        );

        return view('gift.index', $data);
    }

    /*** Nanum gift add : 상품권 등록 */
    function nwgiftadd(Request $request){

        $query = DB::table('tb_gift')->insert([
            'giftname'=>$request->input('gift_local'),
            'giftname1'=>$request->input('gift_name1'),
            'giftname2'=>$request->input('gift_name2'),
            'giftname3'=>$request->input('gift_name3'),
            'activeflag'=>$request->input('ap_activeflag'),
            'regdate'=>date('Y-m-d H:i:s')
        ]);

        if($query){
            return redirect('/nwgiftlist')->with('status', 'Yes');
        }else{
            return redirect('/nwgiftlist')->with('status', 'No');
        }

    }

    /*** Nanum gift update : 상품권 수정  */
    function nwgiftupdate(Request $request){

        $updateing = DB::table('tb_gift')
            ->where('seq', $request->input('seq'))
            ->update([
                'giftname'=>$request->input('gift_local'),
                'giftname1'=>$request->input('gift_name1'),
                'giftname2'=>$request->input('gift_name2'),
                'giftname3'=>$request->input('gift_name3'),
                'activeflag'=>$request->input('ap_activeflag'),
                'upt_dt'=>date("Y-m-d H:i:s")
            ]);

        return redirect('nwgiftlist');
    }

    /*** Nanum gift delete : 상품권 삭제  */
    function nwgiftdel(Request $request){
        $delete = DB::table('tb_gift')
            ->where('seq', $request->input('seq'))
            ->delete();

        if($delete){
            return back()->with('success','삭제 되었습니다.');
        }else{
            return back()->with('fail','삭제관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }
    }

}
