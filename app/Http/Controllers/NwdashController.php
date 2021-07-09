<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use phpseclib3\Crypt\DSA\Formats\Keys\Raw;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NwdashController extends Controller
{

    /*** Dashboard */
    function index(){

        /*** 상점 관리자 */
        if(Auth::user()->level == 9) {
            $menu_query = DB::table('TB_MENU')
                ->where('MENU_ID', '=', Auth::user()->storelevel)
                ->first();

            $first_menu = explode("|",$menu_query->MENU_ARR);
            $first_menu_name = explode("_", $first_menu[0]);

            if($first_menu_name[1] == "서비스 현황"){ return redirect('/nwdashboard');  }
            if($first_menu_name[1] == "고객정보관리"){ return redirect('/nwuserlist');   }
//            if($first_menu_name[1] == "장비등록현황"){ return redirect('/nwapmgtlist');  }

            if($first_menu_name[1] == "전체리스트"){  return redirect('/newapmgtlist'); }
            if($first_menu_name[1] == "등록리스트"){  return redirect('/newapmgtreadylist'); }
            if($first_menu_name[1] == "서비스리스트"){  return redirect('/newapmgtservicelist'); }

            if($first_menu_name[1] == "이력현황"){ return redirect('/nwaphistorylist');  }
            if($first_menu_name[1] == "AP코드관리"){  return redirect('/nwaplist'); }
            if($first_menu_name[1] == "AP설치상점관리"){  return redirect('/nwpromlist'); }

        }


        /***
         * AP 상태 그래프 ( 0 – 미설치 / 1 – 정상 / 2 – 장애   )
         */
        $apstatus = DB::select('select A.thedate
			,(SELECT count(1) FROM TB_AP_STATUS B WHERE date(B.SVC_DT)=A.thedate AND AP_STS=0) AS cnt0
			,(SELECT count(1) FROM TB_AP_STATUS C WHERE date(C.SVC_DT)=A.thedate AND AP_STS=1) AS cnt1
			,(SELECT count(1) FROM TB_AP_STATUS D WHERE date(D.SVC_DT)=A.thedate AND AP_STS=2) AS cnt2
		from
			(select date(DATE_ADD(NOW(), INTERVAL -6 DAY) ) as thedate union all
			      select date(DATE_ADD(NOW(), INTERVAL -5 DAY) ) union all
			      select date(DATE_ADD(NOW(), INTERVAL -4 DAY) ) union all
			      select date(DATE_ADD(NOW(), INTERVAL -3 DAY) ) union all
			      select date(DATE_ADD(NOW(), INTERVAL -2 DAY) ) union all
			      select date(DATE_ADD(NOW(), INTERVAL -1 DAY) ) union all
			      select date(DATE_ADD(NOW(), INTERVAL -0 DAY) )
			     ) A  ');


        $data = array(
            /*** 서비스 개요 */
            'totalconn' => DB::table('TB_AP_VISIT')->select(DB::raw('count(*) as totalconn_tot'))->get(),

            'nowconn' => DB::table('TB_AP_VISIT')
                ->whereRaw('DATE_FORMAT(UPD_DT, "%Y-%m-%d") = CURDATE()')
//                ->where('REG_DT', '>=', 'DATE_ADD(NOW(), INTERVAL -1 HOUR)')
                ->select(DB::raw('count(*) as nowconn_tot'))
                ->get(),

            'todayapply' => DB::table('TB_USER')
                ->whereRaw('DATE_FORMAT(REG_DT, "%Y-%m-%d") = CURDATE()')
                ->select(DB::raw('count(*) as todayapply_tot'))
                ->get(),

            'totaluser' => DB::table('TB_USER')
                ->select(DB::raw('count(*) as totaluser_tot'))
                ->get(),
            // 플랫폼 지표
            /*** 가맹점 수
             * TB_MBR CHECK > 0 이상
             */
            'apstorecnt' => DB::table('TB_MBR')
                ->where('CHECK', '>', '0')
                ->where('CHECK', '<', '6')
                ->select(DB::raw('count(*) as apstorecnt_tot'))->get(),

            /*** 신규 AP
             * 당일기준 가입한 AP
             */
            'todayapcnt' => DB::table('TB_AP')->whereRaw('DATE_FORMAT(REG_DT, "%Y-%m-%d") = CURDATE()')->select(DB::raw('count(*) as todayapcnt_tot'))->get(),

            /*** 활성 AP
             * 네트워크 상태 기준 | AP_STS = 네트워크 서비스 상태(등록:0 / 상점 매칭(서비스 개시) :1 / 서비스 중지:2 )
             */
            'useapcnt' => DB::table('TB_AP')->whereIn('AP_STS', [1])->select(DB::raw('count(*) as useapcnt_tot'))->get(),
//            'normalcnt' => DB::table('TB_AP')->whereIn('AP_STS', [0])->select(DB::raw('count(*) as normalcnt_tot'))->get(),

            /*** 장애 AP
             * 네트워크 상태 기준 | AP_STS = 네트워크 서비스 상태(등록:0 / 상점 매칭(서비스 개시) :1 / 서비스 중지:2 )
             */
            'failapcnt' => DB::table('TB_AP')->whereIn('AP_STS', [2])->select(DB::raw('count(*) as failapcnt_tot'))->get(),
//            'ninstallcnt' => DB::table('TB_AP')->whereIn('AP_STS', [0])->select(DB::raw('count(*) as ninstallcnt_tot'))->get(),

            /*** 전체 AP | 서비스 + 중지 기준
             * 네트워크 상태 기준 | AP_STS = 네트워크 서비스 상태(등록:0 / 상점 매칭(서비스 개시) :1 / 서비스 중지:2 )
             */
            'aptotalcnt' => DB::table('TB_AP')->whereIn('AP_STS', [1,2])->select(DB::raw('count(*) as aptotalcnt_tot'))->get(),

            /*** 상위 상점정보
            'storeinfo' => DB::table('TB_STORE')
                ->select(DB::raw(' STORE_NAME, (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_STORE.AP_CD = TB_AP_VISIT.AP_CD) AS total, (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_STORE.AP_CD = TB_AP_VISIT.AP_CD AND DATE_FORMAT(REG_DT, "%Y-%m-%d") = CURDATE()) AS today ' ))
                ->where('STEP', '!=', '0')
                ->orderBy('total', 'desc')
                ->limit(6)
                ->get(),
             * */

            /*** 상위 상점정보 */
            'storeinfo' => DB::table('TB_MBR')
//                ->select(DB::raw(' STORE_NAME, (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_MBR.AP_CD = TB_AP_VISIT.AP_CD) AS total, (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_MBR.AP_CD = TB_AP_VISIT.AP_CD AND DATE_FORMAT(REG_DT, "%Y-%m-%d") = CURDATE()) AS today ' ))
                ->select(DB::raw('
                STORE_NAME,
                (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_MBR.STORE_ID = TB_AP_VISIT.AP_CD AND date(TB_AP_VISIT.REG_DT) = date(subdate(now(), INTERVAL 1 DAY))) AS oneday,
                (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_MBR.STORE_ID = TB_AP_VISIT.AP_CD AND date(TB_AP_VISIT.REG_DT) = date(subdate(now(), INTERVAL 2 DAY))) AS twoday,
                (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_MBR.STORE_ID = TB_AP_VISIT.AP_CD AND date(TB_AP_VISIT.REG_DT) = date(subdate(now(), INTERVAL 3 DAY))) AS threeday,
                (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_MBR.STORE_ID = TB_AP_VISIT.AP_CD AND date(TB_AP_VISIT.REG_DT) = date(subdate(now(), INTERVAL 4 DAY))) AS fourday,
                (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_MBR.STORE_ID = TB_AP_VISIT.AP_CD) AS total,
                (SELECT COUNT(*) FROM TB_AP_VISIT WHERE TB_MBR.STORE_ID = TB_AP_VISIT.AP_CD AND DATE_FORMAT(REG_DT, "%Y-%m-%d") = CURDATE()) AS today '
                ))
                ->where('CHECK', '!=', '0')
                ->orderBy('total', 'desc')
                ->limit(5)
                ->get(),

            'infonum' => 1,
            /*** 실시간상태 | Donut chart | 0 미설치   1 정상  2 장애  */
            'realcnt' => DB::table('TB_AP')->select(DB::raw(' COUNT(case when AP_STS = 0 then 1 end ) AS ready, COUNT(case when AP_STS = 1 then 1 end ) AS ok, COUNT(case when AP_STS = 2 then 1 end ) AS err '))->get(),

            /*** 실시간 장비 현황 */
            'realapcnt' => DB::table('TB_AP')->select(DB::raw('
            COUNT(case when AP_STS = 0 then 1 end ) AS astep,
            COUNT(case when AP_STS = 1 then 1 end ) AS bstep,
            COUNT(case when AP_STS = 2 then 1 end ) AS cstep,
            COUNT(case when AP_STS = 3 then 1 end ) AS dstep,
            COUNT(case when AP_STS = 4 then 1 end ) AS estep,
            COUNT(case when AP_STS = 5 then 1 end ) AS fstep
            '))->get(),

            /***  일자별 AP상태 */
            'apstatus' => $apstatus,
            /*** 최근 3일전 미 승인 상점 수 */
            'dashnewuser' => DB::select('SELECT COUNT(*) AS newcnt FROM TB_MBR WHERE `CHECK` = 0 AND  `REGDATE`>=(CURDATE()-INTERVAL 3 DAY) '),
            /*** 탈퇴 상점 수 */
            'dashlate' => DB::select('SELECT COUNT(*) AS latecnt FROM TB_MBR WHERE ACTIVEFLAG = "N" ')
        );

        return view('nwdashboard.index', $data);
    }

    /** 고객 정보 관리 리스트 */
    function userlist(){
        $userinfo = DB::select('SELECT A.SEQ,A.MAC,A.ID,A.PWD,A.NAME,A.AGE,A.SEX,A.AREA1,A.AREA2,A.HP,A.SNS_ID,A.APPLY_AP,A.MOB_DEV,A.MOB_OS,A.REG_DT,A.MOD_DT,(SELECT COUNT(1) FROM TB_AP_VISIT B WHERE B.CUS_CD=A.ID ) VISIT_CNT FROM TB_USER A ORDER BY A.REG_DT DESC ');
        $data = array('userinfo' => $userinfo);

        return view('nwdashboard.userlist', $data);
    }

    /*** 고객정보 업데이트 */
    function userupdate(Request $request){

        $updateing = DB::table('TB_USER')
            ->where('SEQ', $request->input('seq'))
            ->update([
                'HP'=>$request->input('custom_hp')
            ]);

        return redirect('nwuserlist');

    }




    /** AP정보 관리  || AP CODE 관리로 변경됨 */
    function aplist(){

//        이전 소스
//        $data = array(
//            'list' => DB::table('TB_AP')
//                ->join('TB_STORE', 'TB_STORE.STORE_ID', '=', 'TB_AP.STORE_ID')
//                ->select(DB::raw('TB_AP.*, TB_STORE.STORE_NAME, (SELECT COUNT(1) FROM TB_AP_VISIT B WHERE B.AP_CD = TB_AP.AP_CD AND DATE_FORMAT(B.REG_DT, "%Y-%m-%d") = CURDATE() ) VISIT_CNT'))
//                ->get(),
//            'storeid' => DB::table('TB_STORE')
//                ->select('STORE_ID', 'STORE_NAME')
//                ->where('STEP','>', '0')
//                ->get()
//        );

        $data = array(
            'list' => DB::table('TB_AP')
                ->select(DB::raw(' TB_AP.*,  (SELECT TB_MBR.STORE_NAME  FROM TB_MBR WHERE TB_MBR.AP_CD = TB_AP.AP_CD ) AS STORENM '))
                ->get(),

            'storeid' => DB::table('TB_MBR')
                ->select('STORE_ID', 'STORE_NAME')
                ->whereIn('CHECK', [1, 2, 3])
                ->get()
        );

        return view('nwdashboard.aplist', $data);
    }

    /** AP정보 관리 등록  || AP CODE 관리로 변경됨 */
    function apadd(Request $request){

        $query = DB::table('TB_AP')->insert([
            'AP_CD'=>$request->input('ap_cd'),
            'AP_NM'=>$request->input('ap_nm'),
            'TELECOM'=>$request->input('name'),
            'ADDR'=>$request->input('addr'),
            'AP_MODEL'=>$request->input('ap_model'),
            'AP_MAC'=>$request->input('ap_mac'),
            'AP_FAC'=>$request->input('ap_fac'),
            'AP_IP'=>$request->input('ap_ip'),
            'AP_STS'=>0,
            'REG_DT'=>date("Y-m-d H:i:s"),
            'STORE_ID'=>$request->input('store_id'),
            'MOD_ID'=>Auth::user()->user_id,
            'MOD_DT'=>date("Y-m-d H:i:s")
        ]);

        if($query){
            return back()->with('success','데이터가 성공적으로 등록 되었습니다.');
        }else{
            return back()->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }

    }

    /** AP정보 관리  업데이트  || AP CODE 관리로 변경됨 */
    function apupdate(Request $request){

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
            $localcode = $localcode + 3;
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

        /*** 기존 연결된 등급 4, 5 AP 기기에서 해당 스토어 자료 삭제  */
        $tbapdelsearch = DB::table('TB_AP')->whereIn('STORE_ID', [(int)$request->input('store_id')])->get();
        foreach ($tbapdelsearch as $tbapdelsearchs){
            $up1query = DB::table('TB_AP')
                ->where('SEQ', $tbapdelsearchs->SEQ)
                ->update([
                    "STORE_ID" => str_replace($request->input('store_id').'|', '',  $tbapdelsearchs->STORE_ID)
                ]);
        }

        $updateing = DB::table('TB_AP')
            ->where('SEQ', $request->input('seq'))
            ->update([
                'AP_CD'=>$ap_code,
                'AP_NM'=>$request->input('ap_nm'),
                'AP_IP'=>$request->input('ap_ip'),
                'STORE_ID'=>$request->input('store_id')."|",
                'UPD_ID'=>Auth::user()->user_id,
                'UPD_DT'=>date("Y-m-d H:i:s")
            ]);

        /*** TB_MBR AP CODE Update */
        $apcodeupdate = DB::table('TB_MBR')
            ->where('STORE_ID', (int)$request->input('store_id'))
            ->update([
                'AP_CD'=>$ap_code
            ]);

        /*** 지역별일련번호 관리 테이블  */
        $query1 = DB::table('TB_LOCAL_NUM')->insert([
            'LOC_NUMBER'=>$localcode,
            'AP_ID'=>$request->input('seq'),
            'REGDATE'=>date("Y-m-d H:i:s")
        ]);

        return redirect('nwaplist');

    }

    /** AP정보 관리 삭제  || AP CODE 관리로 변경됨  */
    function apdel(Request $request){

        $delete = DB::table('TB_AP')
            ->where('SEQ', $request->input('seq'))
            ->delete();

        if($delete){
            return back()->with('success','삭제 되었습니다.');
        }else{
            return back()->with('fail','삭제관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }

    }

//    function apmap(){
//        return view('nwdashboard.apmap');
//    }

    /** AP 설치상점관리 리스트 */
    function storeaplist(){
        $data = array(
            'list' => DB::table('TB_STORE')->get()
        );

        return view('nwdashboard.storeaplist', $data);
    }

    /** AP 설치상점관리 등록 */
    function storeapadd(Request $request){

        $query = DB::table('TB_STORE')->insert([
            'STORE_NAME'=>$request->input('store_name'),
            'CEO'=>$request->input('ceo'),
            'MANAGER'=>$request->input('manager'),
            'AP_CD'=>$request->input('ap_model'),
            'ADDR'=>$request->input('addr'),
            'TELNO'=>$request->input('telno'),
            'STEP'=>$request->input('step'),
            'TELECOM'=>$request->input('telecom'),
            'POS'=>$request->input('pos'),
            'REGDATE'=>date("Y-m-d H:i:s"),
            'USER_ID'=>Auth::user()->user_id,
            'UPD_DT'=>date("Y-m-d H:i:s")

        ]);

        if($query){
            return back()->with('success','데이터가 성공적으로 등록 되었습니다.');
        }else{
            return back()->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }
    }

    /** AP 설치상점관리 업데이트 */
    function storeapupdate(Request $request){

        $updateing = DB::table('TB_STORE')
            ->where('STORE_ID', $request->input('store_id'))
            ->update([
                'STORE_NAME'=>$request->input('store_name'),
                'CEO'=>$request->input('ceo'),
                'MANAGER'=>$request->input('manager'),
                'AP_CD'=>$request->input('ap_model'),
                'ADDR'=>$request->input('addr'),
                'TELNO'=>$request->input('telno'),
                'STEP'=>$request->input('step'),
                'TELECOM'=>$request->input('telecom'),
                'POS'=>$request->input('pos'),
                'USER_ID'=>Auth::user()->user_id,
                'UPD_DT'=>date("Y-m-d H:i:s")
            ]);

        return redirect('nwstoreaplist');

    }

    /** AP 설치상점관리 삭제 */
    function storeapdel(Request $request){

        $delete = DB::table('TB_STORE')
            ->where('STORE_ID', $request->input('store_id'))
            ->delete();

        if($delete){
            return back()->with('success','삭제 되었습니다.');
        }else{
            return back()->with('fail','삭제관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }
    }

    /** AP 상점 설치관리 리스트 */
    function promlist(){

        /*** 상점 관리 */
        $mar_query = DB::table('TB_MBR');
        if(Auth::user()->level == 9){
            $mar_query = $mar_query->where('STORE_ID', '=', Auth::user()->storekey);
        }
        $mar_query = $mar_query->get();

        $data = array(
            'list' => $mar_query,
            'giftlist' => DB::table('tb_gift')->get(),
            'reselnum'=>''
        );

        return view('nwdashboard.promlist', $data);
    }

    /** AP 상점 설치관리 리스트 search 결과  */
    function promserchlist(Request $request){

        if($request->input('selchval') == "all"){
            return redirect('nwpromlist');
        }

        $data = array(
            'list' => DB::table('TB_MBR')
                ->where('CHECK','=',$request->input('selchval'))
                ->get(),
            'giftlist' => DB::table('tb_gift')->get(),
            'reselnum'=>$request->input('selchval')
        );

        return view('nwdashboard.promlist', $data);

    }



    /** AP 상점 신규등록 페이지  */
    function promnew(){
        if(Auth::user()->level != 10){
            return redirect('nwpromlist');
        }

        $data = array(
            'giftlist' => DB::table('tb_gift')->get()
        );
        return view('nwdashboard.promnew', $data);
    }

    /** AP 상점 수정 페이지  */
    function promedit(Request $request, $id){

        /*** 4등급 상점 */
        $data = array(
            'list' => DB::table('TB_MBR')->where('STORE_ID','=', $id)->get(),
            'giftlist' => DB::table('tb_gift')->get(),
            'sid' => $id,
            'aplist' => DB::table('TB_AP')->where('AP_CD', '<>', '')->get(),
            'aplinklist' => DB::table('TB_AP')->whereIn('STORE_ID', [$id])->get()
        );

        return view('nwdashboard.promedit', $data);
    }

    /** AP 비상점 수정 페이지  */
    function promeditnon(Request $request, $id){

        $tbap_seq = DB::table('TB_AP')->whereIn('STORE_ID', [(int)$id])->get();

        if(sizeof($tbap_seq) > 0){
            foreach ($tbap_seq as $tbap_seqs){
                $tbap_seq = $tbap_seqs->SEQ;
            }
        }else{
            $tbap_seq = 0;
        }

        $data = array(
            'list' => DB::table('TB_MBR')->where('STORE_ID','=', $id)->get(),
            'giftlist' => DB::table('tb_gift')->get(),
            'sid' => $id,
            'aplist' => DB::table('TB_AP')->where('AP_CD', '<>', '')->get(),
            'apseq' => $tbap_seq
        );

        return view('nwdashboard.promeditnon', $data);
    }


    /** AP 상점 설치관리 첨부파일 등록 */
    function promadd(Request $request){

        $query = DB::table('TB_MBR')
            ->select('STORE_ID')
            ->orderBy('STORE_ID', 'desc')
            ->first();

        $store_id =  $query->STORE_ID + 1;

        $files = [];
        $realname = [];
        $thumbnailarr = [];
        if($request->hasfile('filenames'))
        {
            /*** 첨부 파일 image 인지 검증 */
            foreach($request->file('filenames') as $key => $value)
            {
                $tmpmime = explode("/",$value->getClientMimeType());
                if($tmpmime[0] != "image"){
                     return back()->with('fail',$value->getClientOriginalName().' 첨부 파일은 image 파일만 가능합니다. ');
                }
            }

            foreach($request->file('filenames') as $key => $value)
            {
                echo "key => ".$key;
                echo "<br/>";
                echo "value => ".$value;
                echo "<br/>";
                echo $value->extension();
                echo "<br/>";

                echo "mime ==> ";
                echo $value->getClientMimeType();
                echo "<br/>";

                echo "guessExtension ==> ";
                echo $value->guessExtension();
                echo "<br/>";

                echo "getClientSize ==> ";
                echo $value->getSize();
                echo "<br/>";

                echo "getClientOriginalName ==> ";
                echo $value->getClientOriginalName();
                echo "<br/>";

                $name = time().rand(1,100).'.'.$value->extension();
//                $value->move(public_path('uploads/'.$request->input('store_id').'/'), $name);
                $value->move(public_path('uploads/'.$store_id.'/'), $name);

                /*** Save file name */
//                $files[$key] = "uploads/".$request->input('store_id')."/".$name;
                $files[$key] = "uploads/".$store_id."/".$name;

                /*** Real File name Save */
                $realname[$key] = $value->getClientOriginalName();

                /*** Thumbnail image */
                $max_width = 100;
                $max_height = 100;
//                $save_filename = "uploads/".$request->input('store_id').'/thumbnail_'.$name;
                $save_filename = "uploads/".$store_id.'/thumbnail_'.$name;

                /*** Thumbnail arr */
                $thumbnailarr[$key] = $save_filename;


                $src_img = ImageCreateFromJPEG($files[$key]); //JPG파일로부터 이미지를 읽어옵니다
                $img_info = getImageSize($files[$key]);//원본이미지의 정보를 얻어옵니다
                $img_width = $img_info[0];
                $img_height = $img_info[1];

                if(($img_width/$max_width) == ($img_height/$max_height))
                {//원본과 썸네일의 가로세로비율이 같은경우
                    $dst_width=$max_width;
                    $dst_height=$max_height;
                }
                elseif(($img_width/$max_width) < ($img_height/$max_height))
                {//세로에 기준을 둔경우
                    $dst_width=$max_height*($img_width/$img_height);
                    $dst_height=$max_height;
                }
                else{//가로에 기준을 둔경우
                    $dst_width=$max_width;
                    $dst_height=$max_width*($img_height/$img_width);
                }//그림사이즈를 비교해 원하는 썸네일 크기이하로 가로세로 크기를 설정합니다.

                $dst_img = imagecreatetruecolor($dst_width, $dst_height); //타겟이미지를 생성합니다

                ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $dst_width, $dst_height, $img_width, $img_height); //타겟이미지에 원하는 사이즈의 이미지를 저장합니다

                ImageInterlace($dst_img);
                ImageJPEG($dst_img, $save_filename); //실제로 이미지파일을 생성합니다
                ImageDestroy($dst_img);
                ImageDestroy($src_img);


            }
        }else{
            $files[0] = "default.jpg";
            $files[1] = "default.jpg";
            $files[2] = "default.jpg";
            $realname[0] = "noimg";
            $realname[1] = "noimg";
            $realname[2] = "noimg";
            $thumbnailarr[0] = "default.jpg";
            $thumbnailarr[1] = "default.jpg";
            $thumbnailarr[2] = "default.jpg";
         }

        $attach_serialize = serialize($files);
        $attachrealnem_serialize = serialize($realname);
        $thumbnail_serialize = serialize($thumbnailarr);

        // 와이파이 유/무 선택값
        if($request->input('ap_wifi_y') == "Y"){
            $wificheck = "Y";
        }else if($request->input('ap_wifi_n') == "N"){
            $wificheck = "N";
        }else{
            $wificheck = "";
        }

        /*** 상점 상태 Y : 상점  | N : 비상점  */
        if($request->input('ap_storetype') =="Y"){
            $query = DB::table('TB_MBR')->insert([

                // Y: 상점 N: 비상점
                "STORETYPE"=>$request->input('ap_storetype'),

                'STORE_NAME'=>$request->input('store_name'),
                'BUSINESS_CODE'=>$request->input('ap_business'),

                // 업종코드
                'INDSTURY'=>$request->input('ap_industry'),
                // 업태
                'INS_TYPE'=>$request->input('ap_instype'),

                // 대표자
                'CEO'=>$request->input('ap_ceo'),
                // 대표자 무선
                'CEO_MOBILE'=>$request->input('ap_ceomobile'),
                // 대표자 유선
                'CEO_TELNO'=>$request->input('ap_ceotelno'),

                // 담당자
                'MGR'=>$request->input('ap_mgr'),
                // 담당자 무선
                'MGR_MOBILE'=>$request->input('ap_mgrmobile'),
                // 담당자 유선
                'MGR_TELNO'=>$request->input('ap_mgrtelno'),

                // E-mail
                'USEREMAIL'=>$request->input('ap_email'),

                // 주소
                'POSTCODE'=>$request->input('postcode'),
                'ADDRESS1'=>$request->input('addr'),
                'ADDRESS2'=>$request->input('addr1'),

                // 상품권 선택
                'gift_card'=>$request->input('giftcheck'),

                // 메모
                'STORE_MEMO'=>$request->input('storememo'),
                // 메모
                'AP_MEMO'=>$request->input('apmemo'),

                // 상점 통신사
                'TELECOM'=>$request->input('aptelecomcheck'),
                'TELECOMOTHER'=>$request->input('ap_telecomother'),

                // 상점 가입상품
                'SUBSCRIPTION'=>$request->input('subscriptioncheck'),

                // POS
                'APPOS'=>$request->input('poscheck'),

                // 와이파이 유/무
                'STORE_WIFI'=>$wificheck,

                // 와이파이 유 / 소유 / 임대
                'STORE_WIFI_CHECK'=>$request->input('ap_wifi_state'),

                // 와이파이 ssid id
                'STORE_WIFI_ID'=>$request->input('ap_ssid_id'),

                // 와이파이 ssid pw
                'STORE_WIFI_PW'=>$request->input('ap_ssid_pw'),

                // 상점 통신요금
                'AP_COMM_FEE'=>$request->input('ap_comm_fee'),

                // 상점상태
                'CHECK'=>$request->input('apcheck'),

                // 첨부 파일
                'ATTACH_FILE'=>$attach_serialize,

                // 첨부 파일 실제 이름
                'ATTACH_REALNAME'=>$attachrealnem_serialize,

                // 첨부파일 썸네일
                'THUMBNAIL_FILE'=>$thumbnail_serialize,

                // 등록자
                'USERID'=>Auth::user()->user_id,

                // 등록일
                'REGDATE'=>date("Y-m-d H:i:s")

            ]);
        }else{
            /*** 비상점 가입 쿼리 */
            $query = DB::table('TB_MBR')->insert([

                // Y: 상점 N: 비상점
                "STORETYPE"=>$request->input('ap_storetype'),

                // 비상점 스토어 네임 (가로등, 폴대, 나무, 돌(바위), 기타)
                "NONSTORENAME"=>$request->input('ap_nonstorename'),

                // 비상점 설치장소명
                "NONSTORELOC"=>$request->input('ap_nonstoreloc'),

                // 담당자
                'MGR'=>$request->input('ap_mgr'),
                // 담당자 무선
                'MGR_MOBILE'=>$request->input('ap_mgrmobile'),
                // 담당자 유선
                'MGR_TELNO'=>$request->input('ap_mgrtelno'),

                // E-mail
                'USEREMAIL'=>$request->input('ap_email'),

                // 주소
                'POSTCODE'=>$request->input('postcode'),
                'ADDRESS1'=>$request->input('addr'),
                'ADDRESS2'=>$request->input('addr1'),

                // 상품권 선택
                'gift_card'=>$request->input('giftcheck'),

                // 메모
                'STORE_MEMO'=>$request->input('storememo'),

                // 상점 통신사
                'TELECOM'=>$request->input('aptelecomcheck'),
                'TELECOMOTHER'=>$request->input('ap_telecomother'),

                // 상점 가입상품
                'SUBSCRIPTION'=>$request->input('subscriptioncheck'),

                // POS
                'APPOS'=>$request->input('poscheck'),

                // 와이파이 유/무
                'STORE_WIFI'=>$wificheck,

                // 와이파이 유 / 소유 / 임대
                'STORE_WIFI_CHECK'=>$request->input('ap_wifi_state'),

                // 와이파이 ssid id
                'STORE_WIFI_ID'=>$request->input('ap_ssid_id'),

                // 와이파이 ssid pw
                'STORE_WIFI_PW'=>$request->input('ap_ssid_pw'),

                // 상점 통신요금
                'AP_COMM_FEE'=>$request->input('ap_comm_fee'),

                // 상점상태
                'CHECK'=>$request->input('apcheck'),

                // 첨부 파일
                'ATTACH_FILE'=>$attach_serialize,

                // 첨부 파일 실제 이름
                'ATTACH_REALNAME'=>$attachrealnem_serialize,

                // 첨부파일 썸네일
                'THUMBNAIL_FILE'=>$thumbnail_serialize,

                'TEMPUSERID'=>"Nanum",
                'TEMPUSERPW'=>12345678,

                // 등록자
                'USERID'=>Auth::user()->user_id,

                'REGDATE'=>date("Y-m-d H:i:s")
            ]);
        }

        if($query){
            return redirect('nwpromlist')->with('success','데이터가 성공적으로 등록 되었습니다.');
        }else{
            return back()->with('fail','등록관련 문제가 있습니다. 관리자에게 문의 하시기 바랍니다.');
        }

    }

    function promupdate(Request $request){

        // 와이파이 유/무 선택값
        if($request->input('ap_wifi_y') == "Y"){
            $wificheck = "Y";
        }else if($request->input('ap_wifi_n') == "N"){
            $wificheck = "N";
        }else{
            $wificheck = "";
        }


        $files = [];
        $uparr = [];
        $realname = [];
        $thumbnailarr = [];
        if($request->hasfile('filenames'))
        {
            /*** 첨부 파일 image 인지 검증 */
            foreach($request->file('filenames') as $key => $value)
            {
                $tmpmime = explode("/",$value->getClientMimeType());
                if($tmpmime[0] != "image"){
                    return back()->with('fail',$value->getClientOriginalName().' 첨부 파일은 image 파일만 가능합니다. ');
                }
            }

            foreach($request->file('filenames') as $key => $value)
            {
                $name = time().rand(1,100).'.'.$value->extension();
                $value->move(public_path('uploads/'.$request->input('store_id')), $name);
                /*** Save file name */
                $files[$key] = "uploads/".$request->input('store_id')."/".$name;

                /*** Real File name Save */
                $realname[$key] = $value->getClientOriginalName();

                /*** Thumbnail image */
                $max_width = 100;
                $max_height = 100;
                $save_filename = "uploads/".$request->input('store_id').'/thumbnail_'.$name;

                /*** Thumbnail arr */
                $thumbnailarr[$key] = $save_filename;

                $src_img = ImageCreateFromJPEG($files[$key]); //JPG파일로부터 이미지를 읽어옵니다
                $img_info = getImageSize($files[$key]);//원본이미지의 정보를 얻어옵니다
                $img_width = $img_info[0];
                $img_height = $img_info[1];

                if(($img_width/$max_width) == ($img_height/$max_height))
                {//원본과 썸네일의 가로세로비율이 같은경우
                    $dst_width=$max_width;
                    $dst_height=$max_height;
                }
                elseif(($img_width/$max_width) < ($img_height/$max_height))
                {//세로에 기준을 둔경우
                    $dst_width=$max_height*($img_width/$img_height);
                    $dst_height=$max_height;
                }
                else{//가로에 기준을 둔경우
                    $dst_width=$max_width;
                    $dst_height=$max_width*($img_height/$img_width);
                }//그림사이즈를 비교해 원하는 썸네일 크기이하로 가로세로 크기를 설정합니다.

                $dst_img = imagecreatetruecolor($dst_width, $dst_height); //타겟이미지를 생성합니다

                ImageCopyResized($dst_img, $src_img, 0, 0, 0, 0, $dst_width, $dst_height, $img_width, $img_height); //타겟이미지에 원하는 사이즈의 이미지를 저장합니다

                ImageInterlace($dst_img);
                ImageJPEG($dst_img, $save_filename); //실제로 이미지파일을 생성합니다
                ImageDestroy($dst_img);
                ImageDestroy($src_img);


            }

            /*** Thumbnail arr */
            if(!empty($request->input('thumbnail'))){
                $rethumbnailarr = explode("|", $request->input('thumbnail'));
                if(empty($thumbnailarr[0])){ $thumbnailarr[0] = $rethumbnailarr[0]; }
                if(empty($thumbnailarr[1])){ $thumbnailarr[1] = $rethumbnailarr[1]; }
                if(empty($thumbnailarr[2])){ $thumbnailarr[2] = $rethumbnailarr[2]; }

                $upthumbnailarr[0] = $thumbnailarr[0];
                $upthumbnailarr[1] = $thumbnailarr[1];
                $upthumbnailarr[2] = $thumbnailarr[2];

                $thumbnail_serialize = serialize($upthumbnailarr);

            }else{
                if(empty($thumbnailarr[0])){ $thumbnailarr[0] = "default.jpg"; }
                if(empty($thumbnailarr[1])){ $thumbnailarr[1] = "default.jpg"; }
                if(empty($thumbnailarr[2])){ $thumbnailarr[2] = "default.jpg"; }

                $thumbnail_serialize = serialize($thumbnailarr);

            }

            /*** Real File name Save */
            if(!empty($request->input('realname'))){
                $realnamearr = explode("|", $request->input('realname'));
                if(empty($realname[0])){ $realname[0] = $realnamearr[0]; }
                if(empty($realname[1])){ $realname[1] = $realnamearr[1]; }
                if(empty($realname[2])){ $realname[2] = $realnamearr[2]; }

                $uprealnamearr[0] = $realname[0];
                $uprealnamearr[1] = $realname[1];
                $uprealnamearr[2] = $realname[2];

                $attachrealnem_serialize = serialize($uprealnamearr);

            }else{
                if(empty($realname[0])){ $realname[0] = "noimg"; }
                if(empty($realname[1])){ $realname[1] = "noimg"; }
                if(empty($realname[2])){ $realname[2] = "noimg"; }

                $attachrealnem_serialize = serialize($realname);

            }

            /*** Save file name */
            if(!empty($request->input('attach_file'))){
                $reimgarr = explode("|", $request->input('attach_file'));
                if(empty($files[0])){ $files[0] = $reimgarr[0]; }
                if(empty($files[1])){ $files[1] = $reimgarr[1]; }
                if(empty($files[2])){ $files[2] = $reimgarr[2]; }

                $uparr[0] = $files[0];
                $uparr[1] = $files[1];
                $uparr[2] = $files[2];

                $attach_serialize = serialize($uparr);

            }else{
                if(empty($files[0])){ $files[0] = "default.jpg"; }
                if(empty($files[1])){ $files[1] = "default.jpg"; }
                if(empty($files[2])){ $files[2] = "default.jpg"; }

                $attach_serialize = serialize($files);

            }

            /*** Save file DB INSERT */
            $updateing = DB::table('TB_MBR')
                ->where('STORE_ID', $request->input('store_id'))
                ->update([
                    'ATTACH_FILE'=>$attach_serialize,
                    'ATTACH_REALNAME'=>$attachrealnem_serialize,
                    'THUMBNAIL_FILE'=>$thumbnail_serialize
                ]);

        }else{

            /*** Thumbnail arr */
            if(empty($request->input('thumbnail'))){
                $thumbnailarr[0] = "default.jpg";
                $thumbnailarr[1] = "default.jpg";
                $thumbnailarr[2] = "default.jpg";

                $thumbnail_serialize = serialize($thumbnailarr);

                // db 입력
                $updateing = DB::table('TB_MBR')
                    ->where('STORE_ID', $request->input('store_id'))
                    ->update([
                        'THUMBNAIL_FILE'=>$thumbnail_serialize
                    ]);
            }

            /*** Real File name Save */
            if(empty($request->input('realname'))){
                $realname[0] = "noimg";
                $realname[1] = "noimg";
                $realname[2] = "noimg";

                $attachrealnem_serialize = serialize($realname);

                // db 입력
                $updateing = DB::table('TB_MBR')
                    ->where('STORE_ID', $request->input('store_id'))
                    ->update([
                        'ATTACH_REALNAME'=>$attachrealnem_serialize
                    ]);
            }

            /*** Save file name */
            if(empty($request->input('attach_file'))){
                $files[0] = "default.jpg";
                $files[1] = "default.jpg";
                $files[2] = "default.jpg";

                $attach_serialize = serialize($files);

                // db 입력
                $updateing = DB::table('TB_MBR')
                    ->where('STORE_ID', $request->input('store_id'))
                    ->update([
                        'ATTACH_FILE'=>$attach_serialize
                    ]);
            }
        }


        /*** 상점 상태 Y : 상점  | N : 비상점  */
        if($request->input('ap_storetype') =="Y"){
            $updateing = DB::table('TB_MBR')
                ->where('STORE_ID', $request->input('store_id'))
                ->update([
                    'STORE_NAME'=>$request->input('store_name'),
                    'BUSINESS_CODE'=>$request->input('ap_business'),

                    // 업종코드
                    'INDSTURY'=>$request->input('ap_industry'),
                    // 업태
                    'INS_TYPE'=>$request->input('ap_instype'),

                    // 대표자
                    'CEO'=>$request->input('ap_ceo'),
                    // 대표자 무선
                    'CEO_MOBILE'=>$request->input('ap_ceomobile'),
                    // 대표자 유선
                    'CEO_TELNO'=>$request->input('ap_ceotelno'),

                    // 담당자
                    'MGR'=>$request->input('ap_mgr'),
                    // 담당자 무선
                    'MGR_MOBILE'=>$request->input('ap_mgrmobile'),
                    // 담당자 유선
                    'MGR_TELNO'=>$request->input('ap_mgrtelno'),

                    // E-mail
                    'USEREMAIL'=>$request->input('ap_email'),

                    // 주소
                    'POSTCODE'=>$request->input('postcode'),
                    'ADDRESS1'=>$request->input('addr'),
                    'ADDRESS2'=>$request->input('addr1'),

                    // 상품권 선택
                    'gift_card'=>$request->input('giftcheck'),

                    // 메모
                    'STORE_MEMO'=>$request->input('storememo'),
                    // AP 메모
                    'AP_MEMO'=>$request->input('apmemo'),

                    // 상점 통신사
                    'TELECOM'=>$request->input('aptelecomcheck'),
                    'TELECOMOTHER'=>$request->input('ap_telecomother'),

                    // 상점 가입상품
                    'SUBSCRIPTION'=>$request->input('subscriptioncheck'),

                    // POS
                    'APPOS'=>$request->input('poscheck'),

                    // 와이파이 유/무
                    'STORE_WIFI'=>$wificheck,

                    // 와이파이 유 / 소유 / 임대
                    'STORE_WIFI_CHECK'=>$request->input('ap_wifi_state'),

                    // 와이파이 ssid id
                    'STORE_WIFI_ID'=>$request->input('ap_ssid_id'),

                    // 와이파이 ssid pw
                    'STORE_WIFI_PW'=>$request->input('ap_ssid_pw'),

                    // 상점 통신요금
                    'AP_COMM_FEE'=>$request->input('ap_comm_fee'),

                    // 상점상태
                    'CHECK'=>$request->input('apcheck'),

                    // 변경자
                    'USERID'=>Auth::user()->user_id,

                    // 승인 / 미승인
                    'APPROVAL'=>$request->input('ap_approval'),

                    //변경일
                    'UPD_DT'=>date("Y-m-d H:i:s")
                ]);
        }else{

            /*** 비상점 가입 쿼리 */
            $updateing = DB::table('TB_MBR')
                ->where('STORE_ID', $request->input('store_id'))
                ->update([

                    // 비상점 스토어 네임 (가로등, 폴대, 나무, 돌(바위), 기타)
                    "NONSTORENAME"=>$request->input('ap_nonstorename'),
                    // 비상점 설치장소명
                    "NONSTORELOC"=>$request->input('ap_nonstoreloc'),
                    // 담당자
                    'MGR'=>$request->input('ap_mgr'),
                    // 담당자 무선
                    'MGR_MOBILE'=>$request->input('ap_mgrmobile'),
                    // 담당자 유선
                    'MGR_TELNO'=>$request->input('ap_mgrtelno'),
                    // E-mail
                    'USEREMAIL'=>$request->input('ap_email'),
                    // 주소
                    'POSTCODE'=>$request->input('postcode'),
                    'ADDRESS1'=>$request->input('addr'),
                    'ADDRESS2'=>$request->input('addr1'),
                    // 상품권 선택
                    'gift_card'=>$request->input('giftcheck'),
                    // 메모
                    'STORE_MEMO'=>$request->input('storememo'),
                    // 상점 통신사
                    'TELECOM'=>$request->input('aptelecomcheck'),
                    'TELECOMOTHER'=>$request->input('ap_telecomother'),
                    // 상점 가입상품
                    'SUBSCRIPTION'=>$request->input('subscriptioncheck'),
                    // POS
                    'APPOS'=>$request->input('poscheck'),
                    // 와이파이 유/무
                    'STORE_WIFI'=>$wificheck,
                    // 와이파이 유 / 소유 / 임대
                    'STORE_WIFI_CHECK'=>$request->input('ap_wifi_state'),
                    // 와이파이 ssid id
                    'STORE_WIFI_ID'=>$request->input('ap_ssid_id'),

                    // 와이파이 ssid pw
                    'STORE_WIFI_PW'=>$request->input('ap_ssid_pw'),

                    // 상점 통신요금
                    'AP_COMM_FEE'=>$request->input('ap_comm_fee'),

                    // 상점상태
                    'CHECK'=>$request->input('apcheck'),

                    // 등록자
                    'USERID'=>Auth::user()->user_id,

                    // 승인 / 미승인
                    'APPROVAL'=>$request->input('ap_approval'),

                    //변경일
                    'UPD_DT'=>date("Y-m-d H:i:s")
                ]);


            /*** 기존 연결된 등급 5 AP 기기에서 해당 스토어 자료 삭제  */
            $tbapdelsearch = DB::table('TB_AP')->whereIn('STORE_ID', [(int)$request->input('store_id')])->get();
            foreach ($tbapdelsearch as $tbapdelsearchs){
//                echo $tbapdelsearchs->SEQ;

                $up1query = DB::table('TB_AP')
                    ->where('SEQ', $tbapdelsearchs->SEQ)
                    ->update([
                        "STORE_ID" => str_replace($request->input('store_id').'|', '',  $tbapdelsearchs->STORE_ID)
                    ]);
            }

            /*** TB_AP STORE ID 리스트 추출 및 업데이트 */
            $tbapsearch = DB::table('TB_AP')->where('SEQ', '=', $request->input('tbap_seq'))->first();
            $tmp_storeid = $tbapsearch->STORE_ID;
            if(strpos($tmp_storeid,$request->input('store_id')) === false) {
                // 값이 존재 하지 않는다면
                $storeid_list = $tmp_storeid.$request->input('store_id') . "|";

                $tbapupdate = DB::table('TB_AP')
                    ->where('SEQ', $request->input('tbap_seq'))
                    ->update([
                        "STORE_ID" => $storeid_list
                    ]);
            }
        }


        /*** 고객 아이디 생성 */
//        $new_userid = 'Nanum'.$request->input('store_id');
        $new_userid = $request->input('ap_business');
        $user_id_check = DB::table('users')
            ->select(DB::raw('count(*) as user_count'))
            ->where('username','=',$new_userid)
            ->first();

//        echo $user_id_check->user_count;

        if( $user_id_check->user_count < 1 and  $request->input('ap_approval') == 1 ) {
            /*** 상점 승인, 등록이력이 없을 경우 (users) */

            if($request->input('ap_storetype') =="Y"){
                $queryuseradd = DB::table('users')->insert([
                    'auth_type' => 'mysql',
                    'username' => $request->input('ap_business'),
                    'password' => Hash::make($request->input('ap_ceomobile')),
                    'realname' => $request->input('ap_ceo'),
                    'email' => $request->input('ap_email'),
                    'descr' => '상점 관리자',
                    'level' => 9,
                    'storelevel' => 5,
                    'storekey' => $request->input('store_id'),
                    'can_modify_passwd' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'enabled' => 1
                ]);

            }else{
                $queryuseradd = DB::table('users')->insert([
                    'auth_type' => 'mysql',
                    'username' => $request->input('ap_business'),
                    'password' => Hash::make($request->input('ap_ceomobile')),
                    'realname' => $request->input('ap_ceo'),
                    'email' => $request->input('ap_email'),
                    'descr' => '상점 관리자',
                    'level' => 9,
                    'storelevel' => 5,
                    'storekey' => $request->input('store_id'),
                    'can_modify_passwd' => 1,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'enabled' => 1
                ]);
            }




        }

        return redirect('nwpromlist')->with('success','데이터가 성공적으로 업데이트 되었습니다.');
    }



    /** AP 비상점 신규등록 페이지  */
    function promnewnon(){
        $data = array(
            'giftlist' => DB::table('tb_gift')->get()
        );
        return view('nwdashboard.promnewnon', $data);
    }

    /*** AP 상점관리 삭제  */
    function promdel(Request $request){

        if(Auth::user()->user_id == 1 || Auth::user()->storelevel == 1) {

            $query = DB::table('TB_MBR')
                ->where('STORE_ID', '=', $request->input('store_id'))
                ->update([
                    'COMMENT' => $request->input('ap_delcomment'),
                    'CHECK' => 6,
                    'ACTIVEFLAG' => 'N'
                ]);

            /*** 기존 연결된 등급 4, 5 AP 기기에서 해당 스토어 자료 삭제  */
            $tbapdelsearch = DB::table('TB_AP')->whereIn('STORE_ID', [(int)$request->input('store_id')])->get();
            foreach ($tbapdelsearch as $tbapdelsearchs){

                $up1query = DB::table('TB_AP')
                    ->where('SEQ', $tbapdelsearchs->SEQ)
                    ->update([
                        "STORE_ID" => str_replace($request->input('store_id').'|', '',  $tbapdelsearchs->STORE_ID)
                    ]);
            }


            if($request->input('store_type') == "Y") {
                /*** 4등급 상점  */
                if(strlen($request->input('ap_cd')) > 5){
                    /*** 문자열 길이가 5이상이면 ap_cd 코드가 있는거로 간주 함. */

                    if(!empty($request->input('ap_cd'))){

                        /*** 4등급 상점 삭제시 해당 AP 상태 변경 및 store_id list 에서 TB_MBR  CHECK = ‘5’  ‘장비회수’ 처리 */
                        $select1 = DB::table('TB_AP')
                            ->where('AP_CD', '=', $request->input('ap_cd'))
                            ->first();


                        /*** 문자열 | -> , 로 변경 */
                        $change_string = str_replace('|', ',',  $select1->STORE_ID);
                        /*** 마지막 문자열중 ,  삭제 */
                        $change_string = substr($change_string, 0, -1);
                        $upquery2 = DB::table('TB_MBR')
                            ->whereIn('STORE_ID', [$change_string])
                            ->update([
                                'CHECK' => 5
                            ]);

                        $apupdate = DB::table('TB_AP')
                            ->where('AP_CD', '=', $request->input('ap_cd'))
                            ->update([
                                'AP_STS' => 2,
                                'ADM_STS' => 2,
                                'AP_STS_REASON' => 5
                            ]);
                    }
                }
            }

            return redirect('nwpromlist')->with('success','삭제 되었습니다.');
        }
    }

    function emplist(){

        return view('nwdashboard.emplist');
    }
}
