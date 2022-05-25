@extends('master.main')


@section('title','Sign in')

@section('content')

    <div class="row mt-5 justify-content-center">
        <div class="col-md-4">
          <center><img loading="lazy" src="{{ config('app.logo') }}"></center>
          <blockquote class="blockquote border-0 p-0">
          <p class="font-italic lead"> <i class="fa fa-quote-left mr-3"></i>People shouldn't be afraid of their government. Governments should be afraid of their people. - Alan Moore </p>
          </blockquote>
          <div>
          </div>
            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

            <div class="mt-3">
                <form action="{{ route('auth.signin.post') }}" method="POST">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" class="form-control @error('username',$errors) is-invalid @enderror" placeholder="Username" name="username" id="username">
                        @error('username',$errors)
                            <p class="text-danger">{{$errors->first('username')}}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control @error('password',$errors) is-invalid @enderror" placeholder="Password" name="password"
                               id="password">
                        @error('password',$errors)
                        <p class="text-danger">{{$errors->first('password')}}</p>
                        @enderror
                    </div>
                    @include('includes.captcha')
                    <div class="form-group text-center">
                        <div class="row">
                            <div class="col-xs-12 col-md-4 offset-md-4">
                                <button type="submit" class="btn btn-outline-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </div>
                    @include('includes.flash.error')

                </form>
            </div>
                <div class="mt-3">
                    Not a member?
                    <a href="{{route('auth.signup')}}"  style="text-decoration: none" >Sign up here</a><br/>
                    Forgot your password?
                    <a href="/forgotpassword" style="text-decoration: none">Reset it here</a>
                    
                </div>
        </div>
    </div>


@stop
