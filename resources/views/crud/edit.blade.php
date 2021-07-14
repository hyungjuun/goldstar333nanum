<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>Lalavel 8 CURD</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap4.min.css') }}">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 cold-md-offset-3" style="margin-top: 50">
            <h4>{{$Title}} | Laravel CRUD</h4>
            <hr/>
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

            <form action="{{route('update')}}" method="post">
                @csrf
                <input type="hidden" name="cid" value="{{ $info->id }}" />
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $info->name }}">
                    <span style="color:red">@error('name'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label for="">Favotite Color</label>
                    <input type="text" class="form-control" name="favoriteColor" placeholder="Enter Favorite color"  value="{{ $info->favoritecolor }}">
                    <span style="color:red">@error('favoriteColor'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <label for="">email</label>
                    <input type="text" class="form-control" name="email" placeholder="Enter email"  value="{{ $info->email }}">
                    <span style="color:red">@error('email'){{ $message }} @enderror</span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>



</body>
</html>
