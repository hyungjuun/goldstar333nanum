@extends('layouts.nwwifiv1')

@section('title', __('CMS 사용자 관리'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>CMS사용자 관리</h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">CMS 사용자들을 관리합니다.</h3>
                            <div class=" float-sm-right">

                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info" >
                                            <thead>
                                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 109px;" aria-sort="ascending" aria-label="ID: activate to sort column descending">ID</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="이름: activate to sort column ascending">이름</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 172px;" aria-label="업체명: activate to sort column ascending">업체명</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 193px;" aria-label="전화번호: activate to sort column ascending">전화번호</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 294px;" aria-label="권한: activate to sort column ascending">권한</th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 307px;" aria-label="가입일: activate to sort column ascending">가입일</th></tr>
                                            </thead>
                                            <tbody>















                                            <tr onclick="setModify('admin2','관리자1','금하','02-1234-1234','A2')" role="row" class="odd">
                                                <td data-toggle="modal" data-target="#modal-lg" tabindex="0" class="sorting_1">admin2</td>
                                                <td data-toggle="modal" data-target="#modal-lg">관리자1</td>
                                                <td data-toggle="modal" data-target="#modal-lg">금하</td>
                                                <td data-toggle="modal" data-target="#modal-lg">02-1234-1234</td>
                                                <td>




                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin2_1" value="고객정보관리" onclick="authCheck('admin2')" checked="">
                                                            <label for="admin2_1" class="custom-control-label">고객정보관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin2_2" value="APID관리" onclick="authCheck('admin2')">
                                                            <label for="admin2_2" class="custom-control-label">AP ID관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin2_3" value="AP위치보기" onclick="authCheck('admin2')" checked="">
                                                            <label for="admin2_3" class="custom-control-label">AP위치보기</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin2_4" value="AP설치상점관리" onclick="authCheck('admin2')" checked="">
                                                            <label for="admin2_4" class="custom-control-label">AP설치상점관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin2_5" value="홍보관리" onclick="authCheck('admin2')">
                                                            <label for="admin2_5" class="custom-control-label">홍보관리</label>
                                                        </div>

                                                    </div>



                                                </td>
                                                <td>2020-12-06 21:12:45.0</td>
                                            </tr><tr onclick="setModify('admin3','관리자','금하','1111','A2')" role="row" class="even">
                                                <td data-toggle="modal" data-target="#modal-lg" tabindex="0" class="sorting_1">admin3</td>
                                                <td data-toggle="modal" data-target="#modal-lg">관리자</td>
                                                <td data-toggle="modal" data-target="#modal-lg">금하</td>
                                                <td data-toggle="modal" data-target="#modal-lg">1111</td>
                                                <td>




                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin3_1" value="고객정보관리" onclick="authCheck('admin3')" checked="">
                                                            <label for="admin3_1" class="custom-control-label">고객정보관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin3_2" value="APID관리" onclick="authCheck('admin3')">
                                                            <label for="admin3_2" class="custom-control-label">AP ID관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin3_3" value="AP위치보기" onclick="authCheck('admin3')">
                                                            <label for="admin3_3" class="custom-control-label">AP위치보기</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin3_4" value="AP설치상점관리" onclick="authCheck('admin3')" checked="">
                                                            <label for="admin3_4" class="custom-control-label">AP설치상점관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin3_5" value="홍보관리" onclick="authCheck('admin3')" checked="">
                                                            <label for="admin3_5" class="custom-control-label">홍보관리</label>
                                                        </div>

                                                    </div>



                                                </td>
                                                <td>2020-12-06 21:13:21.0</td>
                                            </tr><tr onclick="setModify('admin4','관리자4','금하','1111','A2')" role="row" class="odd">
                                                <td data-toggle="modal" data-target="#modal-lg" tabindex="0" class="sorting_1">admin4</td>
                                                <td data-toggle="modal" data-target="#modal-lg">관리자4</td>
                                                <td data-toggle="modal" data-target="#modal-lg">금하</td>
                                                <td data-toggle="modal" data-target="#modal-lg">1111</td>
                                                <td>




                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin4_1" value="고객정보관리" onclick="authCheck('admin4')">
                                                            <label for="admin4_1" class="custom-control-label">고객정보관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin4_2" value="APID관리" onclick="authCheck('admin4')">
                                                            <label for="admin4_2" class="custom-control-label">AP ID관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin4_3" value="AP위치보기" onclick="authCheck('admin4')">
                                                            <label for="admin4_3" class="custom-control-label">AP위치보기</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin4_4" value="AP설치상점관리" onclick="authCheck('admin4')" checked="">
                                                            <label for="admin4_4" class="custom-control-label">AP설치상점관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin4_5" value="홍보관리" onclick="authCheck('admin4')" checked="">
                                                            <label for="admin4_5" class="custom-control-label">홍보관리</label>
                                                        </div>

                                                    </div>



                                                </td>
                                                <td>2020-12-06 21:13:46.0</td>
                                            </tr><tr onclick="setModify('admin5','관리자','금하','1111','A2')" role="row" class="even">
                                                <td data-toggle="modal" data-target="#modal-lg" tabindex="0" class="sorting_1">admin5</td>
                                                <td data-toggle="modal" data-target="#modal-lg">관리자</td>
                                                <td data-toggle="modal" data-target="#modal-lg">금하</td>
                                                <td data-toggle="modal" data-target="#modal-lg">1111</td>
                                                <td>




                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin5_1" value="고객정보관리" onclick="authCheck('admin5')">
                                                            <label for="admin5_1" class="custom-control-label">고객정보관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin5_2" value="APID관리" onclick="authCheck('admin5')">
                                                            <label for="admin5_2" class="custom-control-label">AP ID관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin5_3" value="AP위치보기" onclick="authCheck('admin5')">
                                                            <label for="admin5_3" class="custom-control-label">AP위치보기</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin5_4" value="AP설치상점관리" onclick="authCheck('admin5')">
                                                            <label for="admin5_4" class="custom-control-label">AP설치상점관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="admin5_5" value="홍보관리" onclick="authCheck('admin5')" checked="">
                                                            <label for="admin5_5" class="custom-control-label">홍보관리</label>
                                                        </div>

                                                    </div>



                                                </td>
                                                <td>2020-12-06 21:14:10.0</td>
                                            </tr><tr onclick="setModify('kwmin','강원 관리자','1111','02-1234-1234','A0')" role="row" class="odd">
                                                <td data-toggle="modal" data-target="#modal-lg" tabindex="0" class="sorting_1">kwmin</td>
                                                <td data-toggle="modal" data-target="#modal-lg">강원 관리자</td>
                                                <td data-toggle="modal" data-target="#modal-lg">1111</td>
                                                <td data-toggle="modal" data-target="#modal-lg">02-1234-1234</td>
                                                <td>


                                                    미승인





                                                </td>
                                                <td>2020-12-01 15:18:36.0</td>
                                            </tr><tr onclick="setModify('test_01','테스트사용자','테스트회사','01012341234','A2')" role="row" class="even">
                                                <td data-toggle="modal" data-target="#modal-lg" tabindex="0" class="sorting_1">test_01</td>
                                                <td data-toggle="modal" data-target="#modal-lg">테스트사용자</td>
                                                <td data-toggle="modal" data-target="#modal-lg">테스트회사</td>
                                                <td data-toggle="modal" data-target="#modal-lg">01012341234</td>
                                                <td>




                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="test_01_1" value="고객정보관리" onclick="authCheck('test_01')">
                                                            <label for="test_01_1" class="custom-control-label">고객정보관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="test_01_2" value="APID관리" onclick="authCheck('test_01')">
                                                            <label for="test_01_2" class="custom-control-label">AP ID관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="test_01_3" value="AP위치보기" onclick="authCheck('test_01')">
                                                            <label for="test_01_3" class="custom-control-label">AP위치보기</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="test_01_4" value="AP설치상점관리" onclick="authCheck('test_01')">
                                                            <label for="test_01_4" class="custom-control-label">AP설치상점관리</label>
                                                        </div>
                                                        <div class="custom-control custom-checkbox">
                                                            <input class="custom-control-input" type="checkbox" id="test_01_5" value="홍보관리" onclick="authCheck('test_01')" checked="">
                                                            <label for="test_01_5" class="custom-control-label">홍보관리</label>
                                                        </div>

                                                    </div>



                                                </td>
                                                <td>2020-12-13 17:05:45.0</td>
                                            </tr></tbody>
                                            <tfoot>
                                            <tr><th rowspan="1" colspan="1">ID</th><th rowspan="1" colspan="1">이름</th><th rowspan="1" colspan="1">업체명</th><th rowspan="1" colspan="1">전화번호</th><th rowspan="1" colspan="1">권한</th><th rowspan="1" colspan="1">가입일</th></tr>
                                            </tfoot>
                                        </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 6 of 6 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
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

@endsection

@section('scripts')

@endsection
