@extends('layouts.librenmsv1')

@section('title', __('About'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">1111111111111111</div>
        </div>
    </div>
    <h1>infomation</h1>




@endsection

@section('scripts')
    <script>
        $("[name='statistics']").bootstrapSwitch('offColor','danger','size','mini');
        $('input[name="statistics"]').on('switchChange.bootstrapSwitch',  function(event, state) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'ajax_form.php',
                data: { type: "callback-statistics", state: state},
                dataType: "json",
                success: function(data){},
                error:function(){
                    return $("#switch-state").bootstrapSwitch("toggle");
                }
            });
        });
        $('#clear-stats').click(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'ajax_form.php',
                data: { type: "callback-clear"},
                dataType: "json",
                success: function(data){
                    location.reload(true);
                },
                error:function(){}
            });
        });

        var ver_date = $('#version_date');
        if (ver_date.text()) {
            ver_date.text(' - '.concat(moment.unix(ver_date.text()))).show();
        }
    </script>
@endsection
