<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NapmgtController extends Controller
{

    /*** AP 장비 전체 리스트 */
    function newapmgtlist()
    {

        $data = array(
            'list' => DB::table('TB_AP')
                ->select('TB_AP.SEQ', 'TB_AP.AP_NM', 'TB_AP.AP_MAC', 'TB_AP.SERIAL_NO', 'TB_AP.AP_CD', 'TB_AP.AP_IP', 'TB_AP.AP_STS', 'TB_AP.ADM_STS', 'TB_AP.AP_STS_REASON', 'TB_AP.REG_DT', 'TB_AP.UPD_ID', 'TB_AP.AP_MODEL', 'TB_AP.AP_MAC', 'TB_AP.STORE_ID', 'TB_AP.AP_FAC', 'TB_MBR.STORE_NAME', 'TB_MBR.POSTCODE',  'TB_MBR.ADDRESS1', 'TB_MBR.ADDRESS2', 'TB_AP.WORKER1' )
                ->leftJoin('TB_MBR', 'TB_MBR.STORE_ID', '=', 'TB_AP.STORE_ID')
                ->get()
        );

        return view('apmgt.apmgt_list', $data);

    }

    /*** AP 장비 등록 */
    function newapmgtadd(){
        $data = array(
            'storeid' => DB::table('TB_MBR')
                ->select('STORE_ID', 'STORE_NAME')
                ->where('ACTIVEFLAG', '=', 'Y')
                ->whereIn('CHECK', [1, 2, 3])
                ->get()
        );

        return view('apmgt.apmgt_add', $data);
    }

    /*** AP 장비 DB 등록 */
    function newapmgtinsert(Request $request){

        $query1 = DB::table('TB_AP')->insert([
            'AP_NM'=>$request->input('ap_nm'),
            'AP_CD'=>$request->input('ap_cd'),
            'AP_IP'=>$request->input('ap_ip'),
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_FAC'=>$request->input('ap_fac'),
            'SERIAL_NO'=>$request->input('ap_serial'),
            'AP_STS'=>0,
            'AP_MAC'=>$request->input('ap_mac'),
            'REG_DT'=>date("Y-m-d H:i:s"),
            'UPD_ID'=>Auth::user()->user_id,
            'UPD_DT'=>date("Y-m-d H:i:s")
        ]);

        $query2 = DB::table('TB_AP_LOG')->insert([
            'AP_NM'=>$request->input('ap_nm'),
            'AP_CD'=>$request->input('ap_cd'),
            'AP_IP'=>$request->input('ap_ip'),
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_FAC'=>$request->input('ap_fac'),
            'SERIAL_NO'=>$request->input('ap_serial'),
            'AP_STS'=>0,
            'AP_MAC'=>$request->input('ap_mac'),
            'REG_DT'=>date("Y-m-d H:i:s"),
            'UPD_ID'=>Auth::user()->user_id,
            'UPD_DT'=>date("Y-m-d H:i:s")
        ]);

        if($query1){
            return redirect('newapmgtlist')->with('success','데이터가 성공적으로 등록 되었습니다.');
        }else{
            return redirect('newapmgtlist')->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }

    }

    /*** New AP 장비관리 수정 페이지 */
    function newapmgtedit(Request $request, $id){

        /*** 상점 정보 로드 추출 */
        $storyquery = DB::table('TB_AP')->select('STORE_ID')->where('SEQ','=', $id)->get();

        $data = array(
            'list' => DB::table('TB_AP')->where('SEQ','=', $id)->get(),
            'storeinfo' => DB::table('TB_MBR')->where('STORE_ID','=', $storyquery[0]->STORE_ID)->get(),
            'storeid' => DB::table('TB_MBR')
                ->select('STORE_ID', 'STORE_NAME')
                ->where('APPROVAL', '=', 1)
                ->whereIn('CHECK', [1, 2, 3])
                ->get(),
            'aphistory' => DB::table('TB_AP_LOG')
                ->where('PARENT_KEY', '=', $id)
                ->orderBy('REG_DT', 'desc')
            ->get(),
            'apmemolist' => DB::table('TB_MEMO')
                ->where('PK', '=', $id)
                ->orderBy('REGDATE', 'desc')
                ->get()
        );

        return view('apmgt.apmgt_edit', $data);
    }

    /*** New AP 장비관리 수정 업데이트 */
    function newapmgtupdate(Request $request){

        /*** AP CODE 가 없거나 신규 생성일때   */
        if( (int)$request->input('store_id') > 0 and $request->input('ap_cd') == ''){

            /*** 가맹점 정보 */
            $search = DB::table("TB_MBR")
                ->select('POSTCODE','ADDRESS1','BUSINESS_CODE','INDSTURY')
                ->where('STORE_ID', '=', $request->input('store_id'))
                ->first();

            /*** 지역 일련번호 */
            $seqcode = DB::table("TB_LOCAL_NUM")
                ->orderBy('REGDATE', 'desc')
                ->first();

            if(empty($seqcode->LOC_NUMBER)){
                $localcode = "000001";
            }else{
                $localcode = $seqcode->LOC_NUMBER;
                $localcode = $localcode + 1;
                $localcode = str_pad($localcode, 6, "0",STR_PAD_LEFT);
            }

            /*** postcode 지역 추출 및 code 생성 */
            $citycode = (int)substr($search->POSTCODE, 0, 2);

            /*** 지역코드 3자리 */
            if($citycode >= 1 and $citycode <= 9) {
                $loc_code = "SEL";
            }elseif ($citycode >= 10 and $citycode <= 20){
                $loc_code = "KYG";
            }elseif ($citycode >= 21 and $citycode <= 23){
                $loc_code = "INC";
            }elseif ($citycode >= 24 and $citycode <= 26){
                $loc_code = "KAW";
            }elseif ($citycode >= 27 and $citycode <= 29){
                $loc_code = "CCB";
            }elseif ($citycode >= 31 and $citycode <= 33){
                $loc_code = "CCN";
            }elseif ($citycode = 30 ){
                $loc_code = "SEJ";
            }elseif ($citycode >= 34 and $citycode <= 35){
                $loc_code = "TAJ";
            }elseif ($citycode >= 36 and $citycode <= 40){
                $loc_code = "KSB";
            }elseif ($citycode >= 41 and $citycode <= 43){
                $loc_code = "TAE";
            }elseif ($citycode >= 44 and $citycode <= 45){
                $loc_code = "USN";
            }elseif ($citycode >= 46 and $citycode <= 49){
                $loc_code = "PUB";
            }elseif ($citycode >= 50 and $citycode <= 53){
                $loc_code = "KSN";
            }elseif ($citycode >= 54 and $citycode <= 56){
                $loc_code = "CLB";
            }elseif ($citycode >= 57 and $citycode <= 60){
                $loc_code = "CLN";
            }elseif ($citycode >= 61 and $citycode <= 62){
                $loc_code = "KWJ";
            }elseif ($citycode = 63){
                $loc_code = "CHJ";
            }

            /*** AP CODE 생성 */
            $ap_code = $loc_code.$localcode.$search->BUSINESS_CODE.$search->POSTCODE.$search->INDSTURY;

            /*** TB AP 업데이트 */
            $updateing = DB::table('TB_AP')
                ->where('SEQ', $request->input('seq'))
                ->update([
                    'AP_CD'=>$ap_code,
                    'AP_NM'=>$request->input('ap_nm'),
                    'AP_IP'=>$request->input('ap_ip'),
                    'AP_MODEL'=>$request->input('ap_model'),
                    'AP_FAC'=>$request->input('ap_fac'),
                    'SERIAL_NO'=>$request->input('ap_serial'),
                    'AP_MAC'=>$request->input('ap_mac'),
                    'AP_STS'=>$request->input('adm_sts'),
                    'STORE_ID'=>$request->input('store_id'),
                    'WORKER1'=>$request->input('ap_worker1'),
                    'UPD_ID'=>Auth::user()->username,
                    'UPD_DT'=>date("Y-m-d H:i:s")
                ]);

            /*** TB_AP_LOG */
            $logquery = DB::table('TB_AP_LOG')->insert([
                'AP_CD'=>$ap_code,
                'AP_NM'=>$request->input('ap_nm'),
                'AP_IP'=>$request->input('ap_ip'),
                'AP_MODEL'=>$request->input('ap_model'),
                'AP_FAC'=>$request->input('ap_fac'),
                'SERIAL_NO'=>$request->input('ap_serial'),
                'AP_MAC'=>$request->input('ap_mac'),
                'AP_STS'=>$request->input('adm_sts'),
                'STORE_ID'=>$request->input('store_id'),
                'WORKER1'=>$request->input('ap_worker1'),
                'UPD_ID'=>Auth::user()->username,
                'PARENT_KEY'=>$request->input('seq'),
                'COMMENT'=>"Modify"
            ]);

            /*** 지역별일련번호 관리 테이블  */
            $query1 = DB::table('TB_LOCAL_NUM')->insert([
                'LOC_NUMBER'=>$localcode,
                'AP_ID'=>$request->input('seq'),
                'REGDATE'=>date("Y-m-d H:i:s")
            ]);

        }else{

            /*** AP CODE 변경이 없을때  */
            /*** TB AP 업데이트 */
            $updateing = DB::table('TB_AP')
                ->where('SEQ', $request->input('seq'))
                ->update([
                    'AP_CD'=>$request->input('ap_cd'),
                    'AP_NM'=>$request->input('ap_nm'),
                    'AP_IP'=>$request->input('ap_ip'),
                    'AP_MODEL'=>$request->input('ap_model'),
                    'AP_FAC'=>$request->input('ap_fac'),
                    'SERIAL_NO'=>$request->input('ap_serial'),
                    'AP_MAC'=>$request->input('ap_mac'),
                    'AP_STS'=>$request->input('adm_sts'),
                    'STORE_ID'=>$request->input('store_id'),
                    'WORKER1'=>$request->input('ap_worker1'),
                    'UPD_ID'=>Auth::user()->username,
                    'UPD_DT'=>date("Y-m-d H:i:s")
                ]);

            /*** TB_AP_LOG */
            $logquery = DB::table('TB_AP_LOG')->insert([
                'AP_CD'=>$request->input('ap_cd'),
                'AP_NM'=>$request->input('ap_nm'),
                'AP_IP'=>$request->input('ap_ip'),
                'AP_MODEL'=>$request->input('ap_model'),
                'AP_FAC'=>$request->input('ap_fac'),
                'SERIAL_NO'=>$request->input('ap_serial'),
                'AP_MAC'=>$request->input('ap_mac'),
                'AP_STS'=>$request->input('adm_sts'),
                'STORE_ID'=>$request->input('store_id'),
                'WORKER1'=>$request->input('ap_worker1'),
                'UPD_ID'=>Auth::user()->username,
                'PARENT_KEY'=>$request->input('seq'),
                'COMMENT'=>"Modify"
            ]);
        }

        if($updateing){
            return redirect('newapmgtlist')->with('success','데이터가 성공적으로 업데이트 되었습니다.');
        }else{
            return redirect('newapmgtlist')->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }
    }

    /*** New AP MEMO Insert */
    function newapapmemoup(Request $request, $type){

        /*** AP MEMO INSERT */
        $memoquery = DB::table('TB_MEMO')->insert([
            'TAG'=>$request->input('memo_tag'),
            'MEMO'=>$request->input('apmemo'),
            'UPD_ID'=>Auth::user()->username,
            'PK'=>$request->input('apseq'),
            'REGDATE'=>date("Y-m-d H:i:s")
        ]);

        if($type == "all"){
            $urlparam = "newapmgtedit/".$request->input('apseq');
        }
        if($type == "ready"){
            $urlparam = "newapmgtreadyedit/".$request->input('apseq');
        }
        if($type == "service"){
            $urlparam = "newapmgtserviceedit/".$request->input('apseq');
        }



        if($memoquery){
            return redirect($urlparam)->with('success','데이터가 성공적으로 업데이트 되었습니다.');
        }else{
            return redirect($urlparam)->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }

    }


    /*** New AP 장비관리 상태 회수 업데이트 */
    function newapmgtreset(Request $request){

        /*** TB AP 업데이트 */
        $resetupdate = DB::table('TB_AP')
            ->where('SEQ', $request->input('seq'))
            ->update([
                'AP_CD'=>'',
                'AP_NM'=>$request->input('ap_nm'),
                'AP_IP'=>'',
                'AP_MODEL'=>$request->input('ap_model'),
                'AP_FAC'=>$request->input('ap_fac'),
                'SERIAL_NO'=>$request->input('ap_serial'),
                'AP_MAC'=>$request->input('ap_mac'),
                'AP_STS'=>0,
                'STORE_ID'=>0,
                'WORKER1'=>'',
                'UPD_ID'=>Auth::user()->username,
                'UPD_DT'=>date("Y-m-d H:i:s")
            ]);

        /*** TB_AP_LOG */
        $logquery = DB::table('TB_AP_LOG')->insert([
            'AP_CD'=>'',
            'AP_NM'=>$request->input('ap_nm'),
            'AP_IP'=>'',
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_FAC'=>$request->input('ap_fac'),
            'SERIAL_NO'=>$request->input('ap_serial'),
            'AP_MAC'=>$request->input('ap_mac'),
            'AP_STS'=>0,
            'STORE_ID'=>0,
            'WORKER1'=>'',
            'UPD_ID'=>Auth::user()->username,
            'PARENT_KEY'=>$request->input('seq'),
            'COMMENT'=>"Reset"
        ]);

        if($resetupdate){
            return redirect('newapmgtlist')->with('success','AP 장비가 초기화 되었습니다. ');
        }else{
            return redirect('newapmgtlist')->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }

    }




    /*** New AP 장비등록 ALL 리스트 */
    function newapmgtreadylist(){

        $data = array(
            'list' => DB::table('TB_AP')
                ->select('TB_AP.SEQ', 'TB_AP.AP_NM', 'TB_AP.AP_MAC', 'TB_AP.SERIAL_NO', 'TB_AP.AP_CD', 'TB_AP.AP_IP', 'TB_AP.AP_STS', 'TB_AP.ADM_STS', 'TB_AP.AP_STS_REASON', 'TB_AP.REG_DT', 'TB_AP.UPD_ID', 'TB_AP.AP_MODEL', 'TB_AP.AP_MAC', 'TB_AP.STORE_ID', 'TB_AP.AP_FAC', 'TB_MBR.STORE_NAME', 'TB_MBR.POSTCODE',  'TB_MBR.ADDRESS1', 'TB_MBR.ADDRESS2', 'TB_AP.WORKER1' )
                ->leftJoin('TB_MBR', 'TB_MBR.STORE_ID', '=', 'TB_AP.STORE_ID')
                ->where('TB_AP.AP_STS', '=', '3')
                ->orWhere(function ($query){
                    $query->whereIn('TB_AP.AP_STS', ['1','4'])
                        ->whereDate('TB_AP.UPD_DT', '>=', Carbon::now()->subDays(2) );
                })
                ->get()
        );

        return view('apmgt.apmgt_readylist', $data);
    }

    /*** New AP 장비 등록 수정 페이지 */
    function newapmgtreadyedit(Request $request, $id){

        /*** 상점 정보 로드 추출 */
        $storyquery = DB::table('TB_AP')->select('STORE_ID')->where('SEQ','=', $id)->get();

        $data = array(
            'list' => DB::table('TB_AP')->where('SEQ','=', $id)->get(),
            'storeinfo' => DB::table('TB_MBR')->where('STORE_ID','=', $storyquery[0]->STORE_ID)->get(),
//            'storeid' => DB::table('TB_MBR')
//                ->select('STORE_ID', 'STORE_NAME')
//                ->whereIn('CHECK', [1, 2, 3])
//                ->get(),
            'apmemolist' => DB::table('TB_MEMO')
                ->where('PK', '=', $id)
                ->orderBy('REGDATE', 'desc')
                ->get()
        );

        return view('apmgt.apmgt_readyedit', $data);
    }

    /*** New AP 장비 등록 수정 업데이트 */
    function newapmgtreadyupdate(Request $request){

        /*** TB AP 업데이트 */
        $updateing = DB::table('TB_AP')
            ->where('SEQ', $request->input('seq'))
            ->update([
                'AP_IP'=>$request->input('ap_ip'),
                'AP_STS'=>$request->input('adm_sts'),
                'WORKER1'=>$request->input('ap_worker1'),
                'UPD_ID'=>Auth::user()->username,
                'UPD_DT'=>date("Y-m-d H:i:s")
            ]);

        /*** TB_AP_LOG */
        $logquery = DB::table('TB_AP_LOG')->insert([
            'AP_CD'=>$request->input('ap_cd'),
            'AP_NM'=>$request->input('ap_nm'),
            'AP_IP'=>$request->input('ap_ip'),
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_FAC'=>$request->input('ap_fac'),
            'SERIAL_NO'=>$request->input('ap_serial'),
            'AP_MAC'=>$request->input('ap_mac'),
            'AP_STS'=>$request->input('adm_sts'),
            'STORE_ID'=>$request->input('store_id'),
            'WORKER1'=>$request->input('ap_worker1'),
            'UPD_ID'=>Auth::user()->username,
            'PARENT_KEY'=>$request->input('seq'),
            'COMMENT'=>"Modify"
        ]);

        if($updateing){
            return redirect('newapmgtreadylist')->with('success','데이터가 성공적으로 업데이트 되었습니다.');
        }else{
            return redirect('newapmgtreadylist')->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }
    }



    /*** New AP 장비 서비스 ALL 리스트 */
    function newapmgtservicelist(){

        $data = array(
            'list' => DB::table('TB_AP')
                ->select('TB_AP.SEQ', 'TB_AP.AP_NM', 'TB_AP.AP_MAC', 'TB_AP.SERIAL_NO', 'TB_AP.AP_CD', 'TB_AP.AP_IP', 'TB_AP.AP_STS', 'TB_AP.ADM_STS', 'TB_AP.AP_STS_REASON', 'TB_AP.REG_DT', 'TB_AP.UPD_ID', 'TB_AP.AP_MODEL', 'TB_AP.AP_MAC', 'TB_AP.STORE_ID', 'TB_AP.AP_FAC', 'TB_MBR.STORE_NAME', 'TB_MBR.POSTCODE',  'TB_MBR.ADDRESS1', 'TB_MBR.ADDRESS2', 'TB_AP.WORKER1' )
                ->leftJoin('TB_MBR', 'TB_MBR.STORE_ID', '=', 'TB_AP.STORE_ID')
                ->where('TB_AP.AP_STS', '=', '1')
                ->orWhere(function ($query){
                    $query->whereIn('TB_AP.AP_STS', ['2','4','5'])
                        ->whereDate('TB_AP.UPD_DT', '>=', Carbon::now()->subDays(2) );
                })
                ->get()
        );

        return view('apmgt.apmgt_service_list', $data);
    }

    /*** New AP 장비 서비스 수정 페이지 */
    function newapmgtserviceedit(Request $request, $id){

        /*** 상점 정보 로드 추출 */
        $storyquery = DB::table('TB_AP')->select('STORE_ID')->where('SEQ','=', $id)->get();

        $data = array(
            'list' => DB::table('TB_AP')->where('SEQ','=', $id)->get(),
            'storeinfo' => DB::table('TB_MBR')->where('STORE_ID','=', $storyquery[0]->STORE_ID)->get(),
//            'storeid' => DB::table('TB_MBR')
//                ->select('STORE_ID', 'STORE_NAME')
//                ->whereIn('CHECK', [1, 2, 3])
//                ->get(),
            'apmemolist' => DB::table('TB_MEMO')
                ->where('PK', '=', $id)
                ->orderBy('REGDATE', 'desc')
                ->get()
        );

        return view('apmgt.apmgt_service_edit', $data);
    }

    /*** New AP 장비 서비스 수정 업데이트 */
    function newapmgtserviceupdate(Request $request){

        /*** TB AP 업데이트 */
        $updateing = DB::table('TB_AP')
            ->where('SEQ', $request->input('seq'))
            ->update([
                'AP_IP'=>$request->input('ap_ip'),
                'AP_STS'=>$request->input('adm_sts'),
                'WORKER1'=>$request->input('ap_worker1'),
                'UPD_ID'=>Auth::user()->username,
                'UPD_DT'=>date("Y-m-d H:i:s")
            ]);

        /*** TB_AP_LOG */
        $logquery = DB::table('TB_AP_LOG')->insert([
            'AP_CD'=>$request->input('ap_cd'),
            'AP_NM'=>$request->input('ap_nm'),
            'AP_IP'=>$request->input('ap_ip'),
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_FAC'=>$request->input('ap_fac'),
            'SERIAL_NO'=>$request->input('ap_serial'),
            'AP_MAC'=>$request->input('ap_mac'),
            'AP_STS'=>$request->input('adm_sts'),
            'STORE_ID'=>$request->input('store_id'),
            'WORKER1'=>$request->input('ap_worker1'),
            'UPD_ID'=>Auth::user()->username,
            'PARENT_KEY'=>$request->input('seq'),
            'COMMENT'=>"Modify"
        ]);

        if($updateing){
            return redirect('newapmgtservicelist')->with('success','데이터가 성공적으로 업데이트 되었습니다.');
        }else{
            return redirect('newapmgtservicelist')->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }
    }





}
