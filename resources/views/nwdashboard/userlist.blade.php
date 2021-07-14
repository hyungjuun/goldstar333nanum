@extends('layouts.nwwifiv1')

@section('title', __('고객정보 관리'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>고객정보 관리 </h1>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">나눔와이파이 장비(AP)에 wifi 로 접속한 사용자 정보를 관리합니다.</h3>
                            <div class=" float-sm-right"> </div>
                        </div>

                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info" style="width: 100%;">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 69px;" aria-sort="ascending" aria-label="MAC">MAC</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 69px;" aria-sort="ascending" aria-label="ID : 고객ID">ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 69px;" aria-label="PWD : Password">PWD</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 69px;" aria-label="NAME">NAME</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 69px;" aria-label="AGE">AGE</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 69px;" aria-label="성별">성별</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 69px;" aria-label="주소">주소</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 92px;" aria-label="전화번호: activate to sort column ascending">핸드폰 번호</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 92px;" aria-label="SNS_ID">SNS_ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 92px;" aria-label="가입 AP">가입한 AP</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 92px;" aria-label="접속환경">접속환경</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 92px;" aria-label="MOB_OS">MOBILE device</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 164px;" aria-label="가입일: activate to sort column ascending">가입일시</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 164px;" aria-label="가입일: activate to sort column ascending">변경일시</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($userinfo as $userinfos)
                                                <tr role="row" class="odd" >
                                                    <td>{{$userinfos->MAC}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->ID}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->PWD}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->NAME}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->AGE}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->SEX}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->AREA1}} {{$userinfos->AREA2}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->HP}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->SNS_ID}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->APPLY_AP}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->MOB_DEV}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->MOB_OS}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->REG_DT}}</td>
                                                    <td onClick="setModify('{{$userinfos->SEQ}}', '{{ $userinfos->ID }}','{{ $userinfos->PWD }}','{{ $userinfos->HP }}','{{ $userinfos->MAC }}','{{ $userinfos->APPLY_AP }}','{{$userinfos->MOB_OS }}','{{ $userinfos->REG_DT }}', '{{$userinfos->MOD_DT}}' )">{{$userinfos->MOD_DT}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">MAC</th>
                                                <th rowspan="1" colspan="1">ID</th>
                                                <th rowspan="1" colspan="1">PWD</th>
                                                <th rowspan="1" colspan="1">NAME</th>
                                                <th rowspan="1" colspan="1">AGE</th>
                                                <th rowspan="1" colspan="1">SEX</th>
                                                <th rowspan="1" colspan="1">주소</th>
                                                <th rowspan="1" colspan="1">핸드폰 번호</th>
                                                <th rowspan="1" colspan="1">SNS_ID</th>
                                                <th rowspan="1" colspan="1">가입AP</th>
                                                <th rowspan="1" colspan="1">접속환경</th>
                                                <th rowspan="1" colspan="1">MOBILE device</th>
                                                <th rowspan="1" colspan="1">가입일시</th>
                                                <th rowspan="1" colspan="1">변경일시</th>
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
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">고객정보수정</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" id="quickForm" method="post" action="/nwuserupdate" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="seq" value="0">

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>고객 ID</label>
                                        <input type="text" name="custom_id" maxlength="30" class="form-control" placeholder="고객 ID" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>고객 Password</label>
                                        <input type="text" name="custom_pw" maxlength="30" class="form-control" placeholder="고객 Password" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>핸드폰 번호</label>
                                        <input type="number" name="custom_hp" maxlength="12" class="form-control" placeholder="핸드폰 번호" oninput="maxLengthCheck(this)" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>MAC</label>
                                        <input type="text" name="custom_mac" maxlength="30" class="form-control" placeholder="MAC" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>가입 AP</label>
                                        <input type="text" name="custom_ap" maxlength="30" class="form-control" placeholder="가입 AP" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>MOBILE device</label>
                                        <input type="text" name="custom_os" maxlength="30" class="form-control" placeholder="OS" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>가입일</label>
                                        <input type="text" name="custom_regdate" maxlength="30" class="form-control" placeholder="가입일" readonly>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>최근접속일자</label>
                                        <input type="text" name="custom_moddt" maxlength="30" class="form-control" placeholder="최근접속일자" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <span>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> 수정</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable(
                {
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "order": [[ 9, "desc" ]],
                    "lengthMenu": [[20, 25, 50, 100, -1], [20, 25, 50, 100, "All"]]
                }
            );
        } );

        function setModify(seq,id,pwd,hp,mac,applyap,mobos,regdate,moddt){

            $('#modal-lg').modal("show");
            $('#quickForm')[0].reset();
            $(".modal-title").text("고객정보수정");
            $('#quickForm')[0].action="/nwuserupdate";
            $( "input[name*='seq']" ).val(seq);
            $( "input[name*='custom_id']" ).val(id);
            $( "input[name*='custom_pw']" ).val(pwd);
            $( "input[name*='custom_hp']" ).val(hp);
            $( "input[name*='custom_mac']" ).val(mac);
            $( "input[name*='custom_ap']" ).val(applyap);
            $( "input[name*='custom_os']" ).val(mobos);
            $( "input[name*='custom_regdate']" ).val(regdate);
            $( "input[name*='custom_moddt']" ).val(moddt);

        }

        function maxLengthCheck(object){
            if (object.value.length > object.maxLength){
                object.value = object.value.slice(0, object.maxLength);
            }
        }

    </script>
@endsection
