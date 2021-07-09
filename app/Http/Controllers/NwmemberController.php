<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpseclib3\Crypt\DSA\Formats\Keys\Raw;
use Illuminate\Support\Facades\Auth;

class NwmemberController extends Controller
{
    /*** Nanum wifi member sign up : 회원가입 */
    function index(){

        $data = array(
            'list' => DB::table('tb_gift')->where('activeflag', '=', 'Y')->get()
        );

        return view('nwmember.index', $data);
    }

    /*** Nanum wifi member sign up : 상점 회원가입 요청 및 등록 */
    function signupadd(Request $request){

        /*** 등록상점인지 체크 | 사업자 등록번호로 처리 */
        $bothcheck = DB::table('TB_MBR')
            ->select(DB::raw('count(*) as checkcnt'))
            ->where('BUSINESS_CODE','=',$request->input('ap_business'))
            ->first();

        if($bothcheck->checkcnt > 0){
            return redirect()->back()->with('success','등록된 사업자 번호('.$request->input('ap_business').')가 있습니다.  ');
        }


        // 첨부 파일 deafult
        $files[0] = "default.jpg";
        $files[1] = "default.jpg";
        $files[2] = "default.jpg";
        $realname[0] = "noimg";
        $realname[1] = "noimg";
        $realname[2] = "noimg";
        $thumbnailarr[0] = "default.jpg";
        $thumbnailarr[1] = "default.jpg";
        $thumbnailarr[2] = "default.jpg";


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
        if($request->input('ap_storetype') == "Y"){
            $query = DB::table('TB_MBR')->insert([

                'STORE_NAME'=>$request->input('storename'),
                'BUSINESS_CODE'=>$request->input('ap_business'),

                // Y: 상점 N: 비상점
                "STORETYPE"=>$request->input('ap_storetype'),

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

                // 첨부 파일
                'ATTACH_FILE'=>$attach_serialize,

                // 첨부 파일 실제 이름
                'ATTACH_REALNAME'=>$attachrealnem_serialize,

                // 첨부파일 썸네일
                'THUMBNAIL_FILE'=>$thumbnail_serialize,

                'TEMPUSERID'=>"Nanum",
                'TEMPUSERPW'=>12345678,
                'REGDATE'=>date("Y-m-d H:i:s"),
                'CHECK'=>0
            ]);

        }else{

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

                // 첨부 파일
                'ATTACH_FILE'=>$attach_serialize,

                // 첨부 파일 실제 이름
                'ATTACH_REALNAME'=>$attachrealnem_serialize,

                // 첨부파일 썸네일
                'THUMBNAIL_FILE'=>$thumbnail_serialize,

                'TEMPUSERID'=>"Nanum",
                'TEMPUSERPW'=>12345678,
                'REGDATE'=>date("Y-m-d H:i:s"),
                'CHECK'=>0
            ]);

        }

        if($query){
            return redirect('/signupinfo')->with('status', 'Yes');
        }else{
            return redirect('/signupinfo')->with('status', 'No');
        }

    }

    function signupinfo(Request $request){

        $data = array(
            'infomessage' => $request->session()->get('status')
        );

        return view('nwmember.infoview', $data);
    }

    /*** 업종코드 검색 화면  */
    function searchcode(){
        return view('nwmember.searchcode');
    }

    /*** Ajax 업종코드 검색 화면  */
    public function ajaxsearch(Request $request){

        $sName = $request->input('sercode');
        $apstatus = DB::table('TB_INDUSTRYCODE')
            ->select('CODE', 'DEPTH1','DEPTH2', 'DEPTH3', 'DEPTH4')
            ->where('CODE', 'like', '%'.$sName.'%')
            ->orwhere('DEPTH1', 'like', '%'.$sName.'%')
            ->orwhere('DEPTH2', 'like', '%'.$sName.'%')
            ->orwhere('DEPTH3', 'like', '%'.$sName.'%')
            ->orwhere('DEPTH4', 'like', '%'.$sName.'%')
            ->get();

        return $apstatus;

//        return response()->json([
//                'success'=>'Added new records.',
//                'data'=>$redata
//            ]);
//        return response()->json(['error'=>$validator->errors()]);

    }
}
