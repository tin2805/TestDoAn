@extends('layouts.base_signin')

@section('content')
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Forgot Password Code for {{$employee->name}}</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<form action="{{route('forgotPassInput')}}" method="post"class="signin-form">
            {{csrf_field()}}
		      		<div class="form-group">
						<input type="hidden" name="email" class="form-control" value="{{$employee->email}}">
		      			<input type="text" name="code" class="form-control" placeholder="Code" required>
		      		</div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
	            </div>
	          </form>
	          <p class="w-100 text-center">&mdash; Or Return Sign In Or Signup &mdash;</p>
	          <div class="social d-flex text-center">
	          	<a href="{{route('login')}}" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Sign In</a>
	          	<a href="{{route('register')}}" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Signup</a>
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

@endsection
