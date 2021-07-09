@extends('layouts.nwwifiv1')

@section('title', __('나눔 메뉴관리'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>메뉴 관리 </h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">등급별 메뉴를 관리합니다.</h3>
                            <div class=" float-sm-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg" onclick="addForm();"><i class="fa fa-edit"></i> 신규등록</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">

                                    @if(Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif

                                    @if(Session::get('fail'))
                                        <div class="alert alert-danget">
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif

                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="상품권 리스트" width="100%;">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="#: activate to sort column ascending">활성상태</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 200px;" aria-label="등급: activate to sort column ascending">등급</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-label="메뉴: activate to sort column ascending">메뉴</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($list as $item)

                                                <?php
                                                $dep1 = explode("|", $item->MENU_ARR);
                                                $cnt = 0;
                                                ?>
                                                @foreach($dep1 as $dep1list)
                                                    <?php
                                                    $dep2 = explode("_",$dep1list);
                                                    if($cnt == 0){
                                                        $tmpcheck = $dep2[0].",";
                                                    }else{
                                                        $tmpcheck = $tmpcheck.$dep2[0].",";
                                                    }
                                                    $cnt++;
                                                    ?>
                                                @endforeach

                                                <tr data-toggle="modal" data-target="#modal-lg"
                                                    onclick="setModify('{{ $item->MENU_ID }}','{{ $item->MENU_NAME }}','{{ $tmpcheck }}','{{ $item->ACTIVEFLAG }}', '{{ $item->CNT1 }}')" role="row" class="odd">
                                                    <td tabindex="0">{{ $item->ACTIVEFLAG }}</td>
                                                    <td tabindex="0">{{ $item->MENU_NAME }} | 활성 유저 {{ $item->CNT1 }}</td>
                                                    <td>
                                                        <?php
                                                        $dep1 = explode("|", $item->MENU_ARR);
                                                        ?>
                                                        @foreach($dep1 as $dep1list)
                                                            <?php
                                                            $dep2 = explode("_",$dep1list);
                                                            ?>
                                                            [{{$dep2[1]}}]
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">활성상태</th>
                                                <th rowspan="1" colspan="1">등급</th>
                                                <th rowspan="1" colspan="1">메뉴</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 등록/수정 폼 -->
    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">신규메뉴등록</h4>
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">×</span>--}}
{{--                    </button>--}}
                </div>
                <form role="form" id="quickForm" method="post" action="/nwmenumgtadd" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="seq" value="">
                    <input type="hidden" name="selectmenu" id="selectmenu" >

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>등급 </label>
                                        <input type="text" name="menulevel" class="form-control" placeholder="5등급 관리자">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>활성상태</label>
                                        <select name="ap_activeflag" id="ap_activeflag" class="form-control">
                                            <option value="Y" selected >활성</option>
                                            <option value="N">비활성</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>메뉴</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="m1" id="menucheck" value="m1_서비스현황"  >
                                        <label class="form-check-label">서비스 현황</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="m2" id="menucheck" value="m2_고객정보관리" >
                                        <label class="form-check-label">고객정보관리</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <label class="form-check-label">장비관리</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="m3s1" id="menucheck" value="m3s1_전체리스트" >
                                        <label class="form-check-label">전체리스트</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="m3s2" id="menucheck" value="m3s2_등록리스트" >
                                        <label class="form-check-label">등록리스트</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="m3s3" id="menucheck" value="m3s3_서비스리스트" >
                                        <label class="form-check-label">서비스리스트</label>
                                    </div>

{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="checkbox" name="m3s1" id="menucheck" value="m3s1_장비등록현황" >--}}
{{--                                        <label class="form-check-label">장비등록현황</label>--}}
{{--                                    </div>--}}
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="m3s4" id="menucheck" value="m3s2_이력현황" >
                                        <label class="form-check-label">이력현황</label>
                                    </div>
                                </div>

{{--                                <div class="col-sm-2">--}}
{{--                                    <div class="form-check">--}}
{{--                                        <input class="form-check-input" type="checkbox" name="m4" id="menucheck" value="m4_AP코드관리"  >--}}
{{--                                        <label class="form-check-label">AP코드관리</label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                
                                <div class="col-sm-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="m5" id="menucheck" value="m5_AP설치상점관리" >
                                        <label class="form-check-label">AP설치상점관리</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <span>
                            <button type="button" class="btn btn-danger delBtn" style=""><i class="far fa-trash-alt"></i> Del</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        function sendclick() {
            var DATA;
            var cnt = 0;
            $('input:checkbox[id="menucheck"]').each(function() {
                if($(this).is(':checked')) {
                    DATA += "|" + ($(this).val());
                    cnt++
                }
            });

            if(cnt < 1){
                alert("메뉴를 선택해 주세요 ");
                return false;
            }
            $("#selectmenu").val(DATA);
            $('#quickForm')[0].submit();
        }

        var addForm = function(){
            <?php /*** checkbox 초기화 */ ?>
            $("input:checkbox[class='form-check-input']").attr("checked", false);

            $('#quickForm')[0].reset();
            $(".modal-title").text("신규메뉴 등록");
            $(".delBtn").hide();
            $('#quickForm')[0].action="/nwmenumgtadd";
        };

        $(document).ready(function () {

            $('#example1').DataTable(
                {
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                }
            );

            $(".delBtn").click(function() {
                if(confirm("정말 삭제하시겠습니까?")){
                    $('#quickForm')[0].action="/nwmenumgtdel";
                    $('#quickForm')[0].submit();
                }
            });

            $('#quickForm').validate({
                rules: {
                    menulevel: { required: true }
                },
                messages: {

                    menulevel: "등급을 입력해 주세요 "
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler:function(){
                    sendclick();
                }
            });
        });



        var setModify = function(seq,name,arr,actflag,cnt){

            $('#quickForm')[0].reset();


            $("input[type=checkbox][checked]").each(
                function () {
                    $(this).attr('checked', false);
                }
            );

            var myArrayData1 =[];
            myArrayData1 = arr.split(",");
            var cntarr = myArrayData1.length;
            for(var i=0; i<cntarr; i++){
                console.log(myArrayData1[i]);

                $("input:checkbox[name='"+myArrayData1[i]+"']").prop("checked", true);
            }

            if(cnt < 1) {
                $(".modal-title").text("메뉴 수정");
                $(".delBtn").show();
            }else{
                $(".modal-title").text("메뉴 수정 | 해당 등급 사용자가 "+cnt+" 명 있습니다.");
                $(".delBtn").hide();
            }

            $('#quickForm')[0].action="/nwmenumgtupdate";
            $( "input[name*='seq']" ).val(seq);
            $( "input[name*='menulevel']" ).val(name);
            $('#ap_activeflag').val(actflag).prop("selected",true);
        };

    </script>
@endsection
