@extends('layouts/auth_layout')
@section('content')
    <form class="form" method="post">
        {{ csrf_field() }}
        <div class="header header-primary text-center">
            <h4>Login</h4>
        </div>
        <!--<p class="text-divider">Or Be Classical</p>-->
        <div class="content" style="padding: 10%;">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('fb_redirect') }}" class="btn btn-block btn-info btn-lg" style="background-color: #3b5998;">FB Login</a>
                </div>
            </div>
        </div>
    </form>
    @if(count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(Session::has('login_error'))
        <div class="alert alert-danger">{{ Session::get('login_error') }}</div>
    @endif
@endsection
