<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use phpseclib3\Crypt\DSA\Formats\Keys\Raw;
use Illuminate\Support\Facades\Auth;


class MgtlistController extends Controller
{

    /*** 장비관리 리스트 */
    function apmgtlist(){

//        $data = array(
//            'list' => DB::table('TB_AP')
//                ->select('TB_AP.SEQ', 'TB_AP.AP_NM', 'TB_AP.AP_MAC', 'TB_AP.SERIAL_NO', 'TB_AP.AP_CD', 'TB_AP.AP_IP', 'TB_AP.AP_STS', 'TB_AP.ADM_STS', 'TB_AP.AP_STS_REASON', 'TB_AP.REG_DT', 'TB_AP.UPD_ID', 'TB_AP.AP_MODEL', 'TB_AP.AP_MAC', 'TB_AP.STORE_ID', 'TB_AP.AP_FAC', 'TB_MBR.STORE_NAME', 'TB_MBR.POSTCODE',  'TB_MBR.ADDRESS1', 'TB_MBR.ADDRESS2' )
//                ->leftJoin('TB_MBR', 'TB_MBR.STORE_ID', '=', 'TB_AP.STORE_ID')
//                ->get()
//        );

        $data = array(
            'list' => DB::table('TB_AP')->get()
        );

        return view('nwapmgt.apmgt_list', $data);
    }

    /*** 장비관리 수정 */
    function apmgtedit(Request $request, $id){
        $apcdquery = DB::table('TB_AP')->select('AP_CD')->where('SEQ','=', $id)->get();

        $data = array(
            'list' => DB::table('TB_AP')->where('SEQ','=', $id)->get(),
            'apcodelist' => DB::table('TB_MBR')->where('AP_CD','=', $apcdquery[0]->AP_CD)->get()
        );

        return view('nwapmgt.apmgt_edit', $data);
    }


    /*** 장비관리 등록 */
    function apmgtadd(Request $request){
        $query = DB::table('TB_AP')->insert([
            'AP_NM'=>$request->input('ap_nm'),
            'AP_IP'=>$request->input('ap_ip'),
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_FAC'=>$request->input('ap_fac'),
            'SERIAL_NO'=>$request->input('ap_serial'),
            'AP_MAC'=>$request->input('ap_mac'),
            'AP_STS'=>0,
            'ADM_STS'=>0,
            'REG_DT'=>date("Y-m-d H:i:s"),
            'UPD_ID'=>Auth::user()->username
        ]);

        /*** log */
        $logquery = DB::table('TB_AP_LOG')->insert([
            'AP_NM'=>$request->input('ap_nm'),
            'AP_IP'=>$request->input('ap_ip'),
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_FAC'=>$request->input('ap_fac'),
            'SERIAL_NO'=>$request->input('ap_serial'),
            'AP_MAC'=>$request->input('ap_mac'),
            'AP_STS'=>0,
            'ADM_STS'=>0,
            'REG_DT'=>date("Y-m-d H:i:s"),
            'UPD_ID'=>Auth::user()->username,
            'COMMENT'=>"Create"
        ]);


        if($query){
            return back()->with('success','데이터가 성공적으로 등록 되었습니다.');
        }else{
            return back()->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }
    }

    /*** 장비관리 업데이트 */
    function apmgtupdate(Request $request){

        /*** 중지사유 */
        if($request->input('adm_sts') == 2){
            $ap_sts_reason = $request->input('ap_sts_reason');
        }else{
            $ap_sts_reason = "";
        }

        $updateing = DB::table('TB_AP')
            ->where('SEQ', $request->input('seq'))
            ->update([
                'AP_NM'=>$request->input('ap_nm'),
                'AP_IP'=>$request->input('ap_ip'),
                'AP_MODEL'=>$request->input('ap_model'),
                'AP_FAC'=>$request->input('ap_fac'),
                'SERIAL_NO'=>$request->input('ap_serial'),
                'AP_STS'=>$request->input('ap_sts'),
                'ADM_STS'=>$request->input('adm_sts'),
                'AP_STS_REASON'=>$ap_sts_reason,
                'AP_MAC'=>$request->input('ap_mac'),
                'UPD_ID'=>Auth::user()->username,
                'UPD_DT'=>date("Y-m-d H:i:s")
            ]);

        /*** log */
        $logquery = DB::table('TB_AP_LOG')->insert([
            'AP_NM'=>$request->input('ap_nm'),
            'AP_IP'=>$request->input('ap_ip'),
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_FAC'=>$request->input('ap_fac'),
            'SERIAL_NO'=>$request->input('ap_serial'),
            'AP_STS'=>$request->input('ap_sts'),
            'ADM_STS'=>$request->input('adm_sts'),
            'AP_STS_REASON'=>$ap_sts_reason,
            'AP_MAC'=>$request->input('ap_mac'),
            'UPD_ID'=>Auth::user()->username,
            'PARENT_KEY'=>$request->input('seq'),
            'COMMENT'=>"Modify"
        ]);

        return redirect('nwapmgtlist');

    }

    /** 장비관리  삭제 */
    function apmgtdel(Request $request){

        /*** 중지사유 */
        if($request->input('adm_sts') == 2){
            $ap_sts_reason = $request->input('ap_sts_reason');
        }else{
            $ap_sts_reason = "";
        }


        $delete = DB::table('TB_AP')
            ->where('SEQ', $request->input('seq'))
            ->delete();

        /*** log */
        $logquery = DB::table('TB_AP_LOG')->insert([
            'AP_NM'=>$request->input('ap_nm'),
            'AP_IP'=>$request->input('ap_ip'),
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_FAC'=>$request->input('ap_fac'),
            'SERIAL_NO'=>$request->input('ap_serial'),
            'AP_STS'=>$request->input('ap_sts'),
            'ADM_STS'=>$request->input('adm_sts'),
            'AP_STS_REASON'=>$ap_sts_reason,
            'AP_MAC'=>$request->input('ap_mac'),
            'UPD_ID'=>Auth::user()->username,
            'PARENT_KEY'=>$request->input('seq'),
            'COMMENT'=>"Del"
        ]);

        if($delete){
            return back()->with('success','삭제 되었습니다.');
        }else{
            return back()->with('fail','삭제관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }

    }

    /** 장비등록현황 리스트  */
    function aphistorylist(Request $request){

        echo $request->input('stdate');
        echo $request->input('endate');
        echo $request->input('ap_sts');

        if( empty($request->input('stdate')) && empty($request->input('endate')) && empty($request->input('ap_sts')) ){

            $data = array(
                'list' => DB::table('TB_AP_LOG')
                    ->orderBy('REG_DT', 'desc')
                    ->get(),
                'datapic_start' => '',
                'datapic_end' => ''
            );

        }else{

            $tmp_start = explode("-",$request->input('stdate'));
            $tmp_end = explode("-",$request->input('endate'));

            $query1 = DB::table('TB_AP_LOG');

            /***  기간제외 전체 */
            if($request->input('ap_sts') == "4") {
                $data_st = '';
                $data_en = '';
            }else{
                if ($request->input('stdate') > 0 && $request->input('endate') > 0) {
                    $query1 = $query1->whereBetween('REG_DT', [$request->input('stdate'), $request->input('endate')]);
                    $data_st = $tmp_start[1] . "/" . $tmp_start[2] . "/" . $tmp_start[0];
                    $data_en = $tmp_end[1] . "/" . $tmp_end[2] . "/" . $tmp_end[0];
                } else {
                    $data_st = '';
                    $data_en = '';
                }
            }

            /***  기간제외 전체 */
            if($request->input('ap_sts') != 4) {
                if (strlen($request->input('ap_sts')) > 0) {
                    $query1 = $query1->where('AP_STS', '=', $request->input('ap_sts'));
                }
            }

            $query1 = $query1->orderBy('REG_DT', 'desc')->get();

            $data = array(
                'list' => $query1,
                'datapic_start' => $data_st,
                'datapic_end' => $data_en
            );

        }

        return view('nwapmgt.apmgt_history_list', $data);
    }


}
