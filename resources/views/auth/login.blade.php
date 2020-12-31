@extends('store.template')

@section('content')

   <br>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">

            <div class="card-header text-center">
                <h3>Inicio de Sesion</h3>
            </div>
           <div class="card-block">
                    <div class="col-md-6 mx-auto text-center">
                        <img src="/imagenes/laravel.png" alt="Store logo" class="card-img-top mx-auto m-2 rounded-circle w-70">
                    
                    </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                     {{ csrf_field() }}
                     <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class=" control-label">E-Mail Address</label>

                                <div class="form-group">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="form-group">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                         </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-12">
                                    <div class="checkbox ">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                               <div class="form-group">
                                
                                    <button type="submit" class="btn  btn-success btn-block">
                                        Iniciar Seccion
                                    </button>
                                 
                                <div>      

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                               
                                </div>
                            </div>
       


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

