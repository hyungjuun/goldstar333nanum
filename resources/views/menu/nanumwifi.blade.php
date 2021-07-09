@if(Auth::user()->level == 10)
<li class="single">
    <a href="{{ url('nwdashboard') }}"><i class="fa fa-tachometer fa-fw fa-lg" ></i> 서비스현황</a>
</li>

<li class="dropdown">
    <a href="{{ url('nwdashboard') }}" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><i
            class="fa fa-wifi fa-fw fa-lg fa-nav-icons hidden-md" aria-hidden="true"></i> <span
            class="hidden-sm"> 가맹점관리</span></a>
    <ul class="dropdown-menu">
        <li><a href="{{ url('nwgiftlist') }}"><i class="fa fa-tachometer fa-lg" aria-hidden="true" style="width:3rem;"></i>  상품권 등록</a></li>
{{--        <li><a href="{{ url('nwdashboard') }}"><i class="fa fa-tachometer fa-lg" aria-hidden="true" style="width:3rem;"></i>  서비스현황</a></li>--}}
        <li><a href="{{ url('nwuserlist') }}"><i class="fa fa-handshake-o fa-lg" aria-hidden="true" style="width:3rem;"></i>  고객정보관리</a></li>

        <li class="dropdown-submenu">
            <a><i class="fa fa-map-signs fa-fw fa-lg" aria-hidden="true"></i> 장비관리</a>

            <ul class="dropdown-menu">
                <li><a href="{{ url('newapmgtlist') }}"><i class="fa fa-th-list fa-fw fa-lg" aria-hidden="true"></i> 전체 리스트</a></li>
                <li role="presentation" class="divider"></li>
                <li><a href="{{ url('newapmgtreadylist') }}"><i class="fa fa-wrench fa-fw fa-lg" aria-hidden="true"></i> 등록 리스트</a></li>
                <li role="presentation" class="divider"></li>
                <li><a href="{{ url('newapmgtservicelist') }}"><i class="fa fa-wifi fa-fw fa-lg" aria-hidden="true"></i> 서비스 리스트</a></li>
                <li role="presentation" class="divider"></li>
                <li><a href="{{ url('nwaphistorylist') }}"><i class="fa fa-list-alt fa-fw fa-lg" aria-hidden="true"></i> 이력조회</a></li>


{{--                <li><a href="{{ url('nwapmgtlist') }}"><i class="fa fa-map-signs fa-fw fa-lg" aria-hidden="true"></i> 장비등록현황</a></li>--}}

            </ul>
        </li>

{{--        <li><a href="{{ url('nwaplist') }}"><i class="fa fa-files-o fa-lg" aria-hidden="true" style="width:3rem;"></i> AP 코드 관리</a></li>--}}
{{--        <li><a href="{{ url('nwapmap') }}"><i class="fa fa-map-marker fa-lg" aria-hidden="true" style="width:3rem;"></i> AP 위치보기</a></li>--}}
{{--        <li><a href="{{ url('nwstoreaplist') }}"><i class="fa fa-cog fa-lg" aria-hidden="true" style="width:3rem;"></i> AP 설치 상점관리</a></li>--}}
        <li><a href="{{ url('nwpromlist') }}"><i class="fa fa-bullhorn fa-lg" aria-hidden="true" style="width:3rem;"></i> AP 설치 상점관리</a></li>
{{--        <li><a href="{{ url('nwemplist') }}"><i class="fa fa-users fa-lg" aria-hidden="true" style="width:3rem;"></i> CMS 사용자 관리</a></li>--}}
{{--        <li><a href="{{ url('nwemplist') }}"><i class="fa fa-users fa-lg" aria-hidden="true" style="width:3rem;"></i> 메뉴관리</a></li>--}}
        <li><a href="{{ url('nwmenumgt') }}"><i class="fa fa-users fa-lg" aria-hidden="true" style="width:3rem;"></i> 메뉴관리</a></li>
    </ul>
</li>
@endif

@if(Auth::user()->level == 9)

    <?php
    $menu_query = DB::table('TB_MENU')
        ->where('MENU_ID', '=', Auth::user()->storelevel)
        ->first();
    $tmp_menu = explode("|",$menu_query->MENU_ARR);
    ?>

    <li class="dropdown">
        <a href="{{ url('nwdashboard') }}" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><i
                class="fa fa-wifi fa-fw fa-lg fa-nav-icons hidden-md" aria-hidden="true"></i> <span
                class="hidden-sm"> 가맹점관리</span></a>

        <ul class="dropdown-menu">
            @foreach($tmp_menu as $tmp_menus)
                <?php
                $level_menu = explode("_",$tmp_menus);
                ?>

            @if($level_menu[1] == "상품권 등록")
            <li><a href="{{ url('nwgiftlist') }}"><i class="fa fa-tachometer fa-lg" aria-hidden="true" style="width:3rem;"></i>  상품권 등록</a></li>
            @endif
            @if($level_menu[1] == "서비스현황")
            <li><a href="{{ url('nwdashboard') }}"><i class="fa fa-tachometer fa-lg" aria-hidden="true" style="width:3rem;"></i>  서비스현황</a></li>
            @endif
            @if($level_menu[1] == "고객정보관리")
            <li><a href="{{ url('nwuserlist') }}"><i class="fa fa-handshake-o fa-lg" aria-hidden="true" style="width:3rem;"></i>  고객정보관리</a></li>
            @endif
            @if($level_menu[1] == "장비등록현황" || $level_menu[1] == "이력조회")
            <li class="dropdown-submenu">
                <a><i class="fa fa-map-signs fa-fw fa-lg" aria-hidden="true"></i> 장비관리</a>

                <ul class="dropdown-menu">
            @endif


                    @if($level_menu[1] == "전체리스트")
                        <li><a href="{{ url('newapmgtlist') }}"><i class="fa fa-map-signs fa-fw fa-lg" aria-hidden="true"></i> 전체리스트</a></li>
                        <li role="presentation" class="divider"></li>
                    @endif

                    @if($level_menu[1] == "등록리스트")
                        <li><a href="{{ url('newapmgtreadylist') }}"><i class="fa fa-map-signs fa-fw fa-lg" aria-hidden="true"></i> 등록리스트</a></li>
                        <li role="presentation" class="divider"></li>
                    @endif

                    @if($level_menu[1] == "서비스리스트")
                        <li><a href="{{ url('newapmgtservicelist') }}"><i class="fa fa-map-signs fa-fw fa-lg" aria-hidden="true"></i> 서비스리스트</a></li>
                        <li role="presentation" class="divider"></li>
                    @endif

                    @if($level_menu[1] == "이력조회")
                    <li><a href="{{ url('nwaphistorylist') }}"><i class="fa fa-list-alt fa-fw fa-lg" aria-hidden="true"></i> 이력조회</a></li>
                    @endif

                    {{--                    @if($level_menu[1] == "장비등록현황")--}}
                    {{--                    <li><a href="{{ url('nwapmgtlist') }}"><i class="fa fa-map-signs fa-fw fa-lg" aria-hidden="true"></i> 장비등록현황</a></li>--}}
                    {{--                    <li role="presentation" class="divider"></li>--}}
                    {{--                    @endif--}}

            @if($level_menu[1] == "장비등록현황" || $level_menu[1] == "이력조회")
                </ul>
            </li>
            @endif

{{--            @if($level_menu[1] == "AP코드관리")--}}
{{--            <li><a href="{{ url('nwaplist') }}"><i class="fa fa-files-o fa-lg" aria-hidden="true" style="width:3rem;"></i> AP코드관리</a></li>--}}
{{--            @endif--}}

            @if($level_menu[1] == "AP설치상점관리")
            <li><a href="{{ url('nwpromlist') }}"><i class="fa fa-bullhorn fa-lg" aria-hidden="true" style="width:3rem;"></i> AP설치상점관리</a></li>
            @endif
            @if($level_menu[1] == "메뉴관리")
            <li><a href="{{ url('nwmenumgt') }}"><i class="fa fa-users fa-lg" aria-hidden="true" style="width:3rem;"></i> 메뉴관리</a></li>
            @endif

            @endforeach

        </ul>
    </li>
@endif
