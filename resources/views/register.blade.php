@extends('master')
@section('master-space')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 align="center">Register  Here</h3>
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
                    @if($errors->has('name'))
                        <div class="error text-danger my-1">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile No">
                    @if($errors->has('mobile'))
                        <div class="error text-danger my-1">{{ $errors->first('mobile') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option selected disabled>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    @if($errors->has('gender'))
                        <div class="error text-danger my-1">{{ $errors->first('gender') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
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
                <input type="submit" value="Register" class="btn btn-primary btn-sm">
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">Already Account Login here</a>
            </form>
        </div>
    </div>
</div>
@endsection