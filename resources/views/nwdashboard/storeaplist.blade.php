@extends('layouts.nwwifiv1')

@section('title', __('AP 설치상점관리'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>AP 설치상점관리</h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">AP가 설치된 상점의 정보를 관리합니다.</h3>
                            <div class=" float-sm-right">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg" onclick="addForm();"><i class="fa fa-edit"></i> 신규등록</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
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
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info" style="width: 100%;">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 44px;" aria-sort="ascending" aria-label="ID: activate to sort column descending">ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 138px;" aria-label="상점명: activate to sort column ascending">상점명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 117px;" aria-label="상점상태: activate to sort column ascending">상점상태</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 142px;" aria-label="전화번호: activate to sort column ascending">전화번호</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 117px;" aria-label="대표자명: activate to sort column ascending">대표자명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 118px;" aria-label="담당자명: activate to sort column ascending">담당자명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 94px;" aria-label="통신사: activate to sort column ascending">통신사</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 66px;" aria-label="POS: activate to sort column ascending">POS</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 307px;" aria-label="주소: activate to sort column ascending">주소</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($list as $lists)
                                            <tr data-toggle="modal" data-target="#modal-lg" onclick="setModify('{{ $lists->STORE_ID }}','{{ $lists->STORE_NAME }}','{{ $lists->TELNO }}','{{ $lists->CEO }}','{{ $lists->MANAGER }}','{{ $lists->TELECOM }}','{{ $lists->POS }}','{{ $lists->ADDR }}','{{ $lists->STEP }}','' )" role="row" class="odd">
                                                <td tabindex="0" class="sorting_1">{{ $lists->STORE_ID }}</td>
                                                <td>{{ $lists->STORE_NAME }}</td>
                                                <td>
                                                    @switch($lists->STEP)
                                                        @case(1) 회원가입 @break
                                                        @case(2) AP 설치 @break
                                                        @case(3) 네트웍 연동@break
                                                        @case(4) 서비스 @break
                                                        @case(5) 철수 @break
                                                        @case(6) 장비회수 @break

                                                        @default
                                                        상태학인필요
                                                    @endswitch
                                                </td>
                                                <td>{{ $lists->TELNO }}</td>
                                                <td>{{ $lists->CEO }}</td>
                                                <td>{{ $lists->MANAGER }}</td>
                                                <td>{{ $lists->TELECOM }}</td>
                                                <td>{{ $lists->POS }}</td>
                                                <td>{{ $lists->ADDR }}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">ID</th>
                                                <th rowspan="1" colspan="1">상점명</th>
                                                <th rowspan="1" colspan="1">상점상태</th>
                                                <th rowspan="1" colspan="1">전화번호</th>
                                                <th rowspan="1" colspan="1">대표자명</th>
                                                <th rowspan="1" colspan="1">담당자명</th>
                                                <th rowspan="1" colspan="1">통신사</th>
                                                <th rowspan="1" colspan="1">POS</th>
                                                <th rowspan="1" colspan="1">주소</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>

    <!-- 등록/수정 폼 -->
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">등록/수정</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <form role="form" id="quickForm" method="post" action="" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="store_id" value="0">
                    <input type="hidden" name="attach_file" value="">
                    <span style="display:none"><input type="file" name="file" class="form-control" placeholder="전단지"></span>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>상점명</label>
                                        <input type="text" name="store_name" class="form-control" placeholder="상점명">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>주소</label>
                                        <input type="text" name="addr" id="addr" onclick="sample6_execDaumPostcode()" class="form-control" placeholder="주소">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>전화번호</label>
                                        <input type="text" name="telno" class="form-control" placeholder="전화번호">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>상점상태</label>
                                        <select name="step" class="form-control step" placeholder="상점상태">
                                            <option value="">선택</option>
                                            <option value="1">회원가입</option>
                                            <option value="2">AP설치</option>
                                            <option value="3">네트웍연동</option>
                                            <option value="4">서비스</option>
                                            <option value="5">철수</option>
                                            <option value="6">장비회수</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>대표자명</label>
                                        <input type="text" name="ceo" class="form-control" placeholder="대표자명">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>통신사</label>
                                        <input type="text" name="telecom" class="form-control" placeholder="통신사">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>담당자명</label>
                                        <input type="text" name="manager" class="form-control" placeholder="담당자명">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>POS</label>
                                        <input type="text" name="pos" class="form-control" placeholder="POS">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <span><button type="button" class="btn btn-danger delBtn"><i class="far fa-trash-alt"></i> Del</button><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button></span>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable(
                {
                    "responsive": true,
                    "autoWidth": true,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                }
            );
        } );

        var addForm = function(){
            $('#quickForm')[0].reset();
            $(".modal-title").text("상점등록");
            $(".delBtn").hide();
            $('#quickForm')[0].action="/nwstoreapadd";

        };

        $(document).ready(function () {

            $(".delBtn").click(function() {
                if(confirm("정말 삭제하시겠습니까?")){
                    $('#quickForm')[0].action="/nwstoreapdel";
                    $('#quickForm')[0].submit();
                }
            });



            $.validator.setDefaults({
                submitHandler: function () {

                    form.submit();
                }
            });

            $('#quickForm').validate({
                rules: {

                    store_name: {
                        required: true
                    },
                    addr: {
                        required: true
                    },
                    telno: {
                        required: true
                    },
                    step: {
                        required: true
                    }
                },
                messages: {

                    store_name: "Please enter a shop Name",
                    addr: "Please enter a address",
                    telno: "Please enter a PhoneNumber",
                    step: "Please enter a step"


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
                }
            });
        });


        var setModify = function(store_id,store_name,telno,ceo,manager,telecom,pos,addr,step,attach_file ){
            $('#quickForm')[0].reset();
            $(".modal-title").text("상점정보수정");
            $(".delBtn").show();
            $('#quickForm')[0].action="/nwstoreapupdate";
            $( "input[name*='store_id']" ).val(store_id);
            $( "input[name*='store_name']" ).val(store_name);
            $( "input[name*='telno']" ).val(telno);
            $( "input[name*='ceo']" ).val(ceo);
            $( "input[name*='manager']" ).val(manager);
            $( "input[name*='telecom']" ).val(telecom);
            $( "input[name*='pos']" ).val(pos);
            $( "input[name*='addr']" ).val(addr);
            $( ".step" ).val(step);
            $( "input[name*='attach_file']" ).val(attach_file);


        }



    </script>

@endsection
