@extends('layouts.nwwifiv1')

@section('title', __('업종코드검색'))

@section('content')
    <div class="container-fluid">
        <div class="row pagerow" >
            <div class="col-md-6 col-xs-12" >
                <h2>업종코드검색</h2>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>업종</label>
                                    <p style="display: flex; margin-bottom: 1rem;">
                                        <input type="text" name="search" id="search" class="form-control col-sm-2" placeholder="00000" style="width: 7em; margin-right: 1rem;">
                                        <button type="button" class="btn btn-info col-sm-4" onclick="searchcode()" >검색</button>
                                    </p>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <table class="col-sm-12" class="table table-bordered table-striped dataTable dtr-inline collapsed" style="width:100%;" id = "boardList" border = "1"></table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .pagerow h1 {text-align: center; color: gray; padding: 2rem; }
        .pagerow h3 {text-align: center; color: gray; padding: 2rem;}
        .modal-body { border-top: 1px solid gray; }
    </style>
@endpush


@section('scripts')
    <script>

        function setParentText(codeval){
            opener.document.getElementById("industry").value = codeval;
            window.close();
        }

        function searchcode() {
            var schtext = $("#search").val();
            if(schtext == ""){
                alert("검색어를 입력해 주세요 !");
                return false;
            }else{
                var _token = $("input[name='_token']").val();
                var sercode = $("#search").val();

                $.ajax({
                    url: "/ajaxsearch",
                    type:'POST',
                    data: {_token:_token, sercode:sercode},
                    success: function(data) {

                        if(data.length > 0){
                            var str = "";
                            str += "<tr><td width='80px'>업종코드</td><td>대분류</td><td>중분류</td><td>소분류</td><td>세세분류</td></tr>";
                            for(var i=0; i<data.length; i++){
                                str += "<tr>";
                                str += "<td onclick='setParentText("+data[i].CODE+")' style='cursor:pointer;'>" + data[i].CODE + "</td>";
                                str += "<td onclick='setParentText("+data[i].CODE+")' style='cursor:pointer;'>" + data[i].DEPTH1 + "</td>";
                                str += "<td onclick='setParentText("+data[i].CODE+")' style='cursor:pointer;'>" + data[i].DEPTH2 + "</td>";
                                str += "<td onclick='setParentText("+data[i].CODE+")' style='cursor:pointer;'>" + data[i].DEPTH3 + "</td>";
                                str += "<td onclick='setParentText("+data[i].CODE+")' style='cursor:pointer;'>" + data[i].DEPTH4 + "</td>";
                                str += "</tr>";
                            }
                            $("#boardList").html(str);

                        }else{
                            str += "<tr>";
                            str += "<td style='width:100%; height:2rem;  text-align: center;'>검색할 내용이 없습니다.</td>";
                            str += "</tr>";
                            $("#boardList").html(str);
                        }

                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown){
                        // 비동기 통신이 실패할경우 error 콜백으로 들어옵니다.
                        alert("통신 실패. 관리자에게 문의바랍니다.")
                    }
                });
            }
        }

    </script>
@endsection

@push('styles')
    <style>
        table { border-color: #c8c8c8; }
        td { padding: 0.1rem 0.4rem; font-size: 12px; border-color: #c8c8c8; }
    </style>
@endpush

