@extends('layouts.nwwifiv1')

@section('title', __('나눔 상품권 관리'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>상품권 관리 </h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">상품권 분류를 관리합니다.</h3>
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
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="상품권 리스트" width="100%">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 101px;" aria-label="AP명: activate to sort column ascending">지역</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="상품권1: activate to sort column ascending">상품권1</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="상품권2: activate to sort column ascending">상품권2</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="상품권3: activate to sort column ascending">상품권3</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-sort="descending" aria-label="활성상태: activate to sort column ascending">활성상태</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="등록일: activate to sort column ascending">등록일</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="등록일: activate to sort column ascending">수정일</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($list as $item)
                                                <tr   role="row" class="odd">
                                                    <td tabindex="0">{{ $item->giftname }}</td>
                                                    <td data-toggle="modal" data-target="#modal-lg" onclick="setModify('{{ $item->seq }}','{{ $item->giftname }}','{{ $item->giftname1 }}','{{ $item->giftname2 }}','{{ $item->giftname3 }}','{{ $item->activeflag }}')">{{ $item->giftname1 }}</td>
                                                    <td data-toggle="modal" data-target="#modal-lg" onclick="setModify('{{ $item->seq }}','{{ $item->giftname }}','{{ $item->giftname1 }}','{{ $item->giftname2 }}','{{ $item->giftname3 }}','{{ $item->activeflag }}')">{{ $item->giftname2 }}</td>
                                                    <td data-toggle="modal" data-target="#modal-lg" onclick="setModify('{{ $item->seq }}','{{ $item->giftname }}','{{ $item->giftname1 }}','{{ $item->giftname2 }}','{{ $item->giftname3 }}','{{ $item->activeflag }}')">{{ $item->giftname3 }}</td>
                                                    <td data-toggle="modal" data-target="#modal-lg" onclick="setModify('{{ $item->seq }}','{{ $item->giftname }}','{{ $item->giftname1 }}','{{ $item->giftname2 }}','{{ $item->giftname3 }}','{{ $item->activeflag }}')">
                                                        @if($item->activeflag == "Y")
                                                            활성
                                                        @else
                                                            비활성
                                                        @endif
                                                    </td>
                                                    <td data-toggle="modal" data-target="#modal-lg" onclick="setModify('{{ $item->seq }}','{{ $item->giftname }}','{{ $item->giftname1 }}','{{ $item->giftname2 }}','{{ $item->giftname3 }}','{{ $item->activeflag }}')">{{ $item->regdate }}</td>
                                                    <td data-toggle="modal" data-target="#modal-lg" onclick="setModify('{{ $item->seq }}','{{ $item->giftname }}','{{ $item->giftname1 }}','{{ $item->giftname2 }}','{{ $item->giftname3 }}','{{ $item->activeflag }}')">{{ $item->upt_dt }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">지역</th>
                                                <th rowspan="1" colspan="1">상품권1</th>
                                                <th rowspan="1" colspan="1">상품권2</th>
                                                <th rowspan="1" colspan="1">상품권3</th>
                                                <th rowspan="1" colspan="1">활성상태</th>
                                                <th rowspan="1" colspan="1">등록일</th>
                                                <th rowspan="1" colspan="1">수정일</th>
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
                    <h4 class="modal-title">상품권 수정</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" id="quickForm" method="post" action="nwgiftupdate" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="seq" value="10">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>지역명 </label>
                                        <input type="text" name="gift_local" class="form-control" placeholder="강원 상품권">
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>상품권 1</label>
                                        <input type="text" name="gift_name1" class="form-control" placeholder="종이" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>상품권 2</label>
                                        <input type="text" name="gift_name2" class="form-control" placeholder="모바일">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>상품권 3</label>
                                        <input type="text" name="gift_name3" class="form-control" placeholder="Pay">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <span>
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

        var addForm = function(){
            $('#quickForm')[0].reset();
            $(".modal-title").text("상품권 등록");
            $('#quickForm')[0].action="/nwgiftadd";
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

            $.validator.setDefaults({
                submitHandler: function () {
                    form.submit();
                }
            });

            $('#quickForm').validate({
                rules: {
                    gift_local: { required: true },
                    gift_name1: { required: true }
                },
                messages: {

                    gift_local: "지역명을 입력해 주세요 ",
                    gift_name1: "상품권 명을 입력해 주세요 "
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

        var setModify = function(seq,local,name1,name2,name3,actflag){
            $('#quickForm')[0].reset();
            $(".modal-title").text("상품권 수정");
            $('#quickForm')[0].action="/nwgiftupdate";
            $( "input[name*='seq']" ).val(seq);
            $( "input[name*='gift_local']" ).val(local);
            $( "input[name*='gift_name1']" ).val(name1);
            $( "input[name*='gift_name2']" ).val(name2);
            $( "input[name*='gift_name3']" ).val(name3);
            $('#ap_activeflag').val(actflag).prop("selected",true);
        };

    </script>
@endsection
