<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            if($first_menu_name[1] == "장비등록현황"){ return redirect('/nwapmgtlist');  }

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
                ->select(DB::raw('count(*) as nowconn_tot'))
                ->get(),

            'todayapply' => DB::table('TB_USER')
                ->whereRaw('DATE_FORMAT(REG_DT, "%Y-%m-%d") = CURDATE()')
                ->select(DB::raw('count(*) as todayapply_tot'))
                ->get(),

            'totaluser' => DB::table('TB_USER')
                ->select(DB::raw('count(*) as totaluser_tot'))
                ->get(),

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

            /*** 장애 AP
             * 네트워크 상태 기준 | AP_STS = 네트워크 서비스 상태(등록:0 / 상점 매칭(서비스 개시) :1 / 서비스 중지:2 )
             */
            'failapcnt' => DB::table('TB_AP')->whereIn('AP_STS', [2])->select(DB::raw('count(*) as failapcnt_tot'))->get(),

            /*** 전체 AP | 서비스 + 중지 기준
             * 네트워크 상태 기준 | AP_STS = 네트워크 서비스 상태(등록:0 / 상점 매칭(서비스 개시) :1 / 서비스 중지:2 )
             */
            'aptotalcnt' => DB::table('TB_AP')->whereIn('AP_STS', [1,2])->select(DB::raw('count(*) as aptotalcnt_tot'))->get(),

            /*** 상위 상점정보 */
            'storeinfo' => DB::table('TB_MBR')
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


    /** AP 상점 설치관리 리스트 */
    function promlist(){

        /*** 상점 관리 */
        $mar_query = DB::table('TB_MBR');
        // hyungjuun 일부 변경함.
//        if(Auth::user()->level == 9){
//            $mar_query = $mar_query->where('STORE_ID', '=', Auth::user()->storekey);
//        }
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

}
