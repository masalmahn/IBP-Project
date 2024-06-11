@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
	@include('layouts.navbars.auth.topnav', ['title' => (@$admin) ? 'Edit '.@$admin->username : 'New Employee' ])
	<div class="container-fluid my-5 py-2">
        <div id="alert">
            @include('components.alert')
        </div>
		<div class="d-flex justify-content-center mb-5">
			<div class="col-lg-9 mt-lg-0 mt-4">

				<div class="card mt-4" id="basic-info">
					<div class="card-header">
						<h5>{{ (@$admin) ? 'Edit '.@$admin->username : 'New Employee' }}</h5>
					</div>
					<div class="card-body pt-0">
						<form method="POST" action="{{ (@$admin) ? route('admins.update') : route('admins.store') }}" enctype="multipart/form-data">
							@csrf
                            <input type="text" name="username" hidden value="{{ @$admin->username }}">

                            <div class="card-body">
                                <p class="text-uppercase text-sm">Employee Information</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Username</label>
                                            <input  class="form-control" type="text" name="username" value="{{ old('username', @$admin->username) }}"
                                                {{ (@$admin) ? 'disabled' : '' }}>
                                            @error('username') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Email address</label>
                                            <input class="form-control" type="email" name="email"  value="{{ old('email', @$admin->email) }}"
                                                {{ (@$admin) ? 'disabled' : '' }}>
                                                @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">First name</label>
                                            <input class="form-control" type="text" name="firstname"  value="{{ old('firstname', @$admin->firstname) }}" >
                                            @error('firstname') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Last name</label>
                                            <input class="form-control" type="text" name="lastname"  value="{{ old('lastname', @$admin->lastname) }}">
                                            @error('lastname') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    {{-- @if (!@$admin) --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Password</label>
                                            <input class="form-control" type="password" name="password" value="{{ old('password') }}">
                                            @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Confirm Password</label>
                                            <input class="form-control" type="password" name="confirm-password" value="{{ old('confirm-password') }}">
                                            @error('confirm-password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Contact Information</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Address</label>
                                            <input class="form-control" type="text" name="address"  value="{{ old('address', @$admin->address) }}">
                                            @error('address') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">City</label>
                                            <input class="form-control" type="text" name="city"  value="{{ old('city', @$admin->city) }}">
                                            @error('city') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Country</label>
                                            <input class="form-control" type="text" name="country"  value="{{ old('country', @$admin->country) }}">
                                            @error('country') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Postal code</label>
                                            <input class="form-control" type="text" name="postal"  value="{{ old('postal', @$admin->postal) }}">
                                            @error('postal') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">About Employee</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">About employee</label>
                                            <input class="form-control" type="text" name="about"  value="{{ old('about', @$admin->about) }}">
                                            @error('about') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="d-flex justify-content-end mt-4">
								<a href="{{ route('admins.show') }}"
									class="btn btn-light m-0">Back</a>
								<button type="submit" class="btn bg-gradient-primary m-0 ms-2">Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		@include('layouts.footers.auth.footer')
	</div>
@endsection
