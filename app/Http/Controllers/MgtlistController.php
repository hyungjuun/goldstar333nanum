<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use phpseclib3\Crypt\DSA\Formats\Keys\Raw;
use Illuminate\Support\Facades\Auth;


class MgtlistController extends Controller
{
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
                'datapic_end' => '',
                'apsts' => $request->input('ap_sts')
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

            echo $data_st;

            $data = array(
                'list' => $query1,
                'datapic_start' => $data_st,
                'datapic_end' => $data_en,
                'apsts' => $request->input('ap_sts')
            );

        }

        return view('nwapmgt.apmgt_history_list', $data);
    }


}
