<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
@extends('master')
@section('master-space')
<div class="container">
        @if(Session::has('msg'))
            <!-- <div class="alert my-2 alert-success alert-dismissible  fade show">
                <span class="close">&times;</span>
                {{ Session::get('msg') }}
            </div> -->
            <script>
                swal("Success","{{ Session::get('msg') }}", "success",{
                    button: true,
                });
            </script>
        @endif
    <div class="row">
        <div class="col-md-6">
            <h3 align="center">Login  Here</h3>
            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email">
                    @if($errors->has('email'))
                        <div class="error text-danger my-1">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                    @if($errors->has('password'))
                        <div class="error text-danger my-1">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <input type="submit" value="Login" class="btn btn-primary btn-sm">
                <a href="{{ route('register') }}" class="btn btn-secondary btn-sm">Register Here</a>
            </form>
        </div>
    </div>
</div>
@endsection