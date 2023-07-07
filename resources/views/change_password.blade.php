@extends('layouts.base_signin')

@section('content')
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Change Password for {{$employee->user_name}}</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<form action="{{route('changePass')}}" method="post"class="signin-form">
            {{csrf_field()}}
		      		<div class="form-group">
						<input type="hidden" name="email" class="form-control" value="{{$employee->email}}">
		      			<input type="password" name="password" class="form-control" placeholder="Password" required>
		      		</div>
					<div class="form-group">
		      			<input type="password" name="re_password" class="form-control" placeholder="Re-enter password" required>
		      		</div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
	            </div>
	          </form>
		      </div>
				</div>
			</div>
		</div>
	</section>

@endsection
