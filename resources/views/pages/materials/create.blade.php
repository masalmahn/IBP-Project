@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => (@$material) ? 'Edit material' : 'Add Material'])
    <div class="container-fluid my-5 py-2">
        <div id="alert">
            @include('components.alert')
        </div>
        <div class="d-flex justify-content-center mb-5">
            <div class="col-lg-9 mt-lg-0 mt-4">

                <div class="card mt-4" id="basic-info">
                    <div class="card-header">
                        <h5>{{ (@$material) ? 'Edit material' : 'Add Material' }}</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form method="POST" action="{{ (@$material) ? route('materials.update') : route('materials.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" hidden value="{{ @$material->id }}">
                            @if (!@$material)
                                <input type="text" name="created_by" hidden value="{{ auth()->id() }}">
                            @endif

                            <div class="card-body">
                                <p class="text-uppercase text-sm">Material Information</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Name</label>
                                            <input  class="form-control" type="text" name="name" value="{{ old('name', @$material->name) }}">
                                            @error('name') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Student Number</label>
                                            <input class="form-control" type="text" name="student_no"  value="{{ old('student_no', @$material->student_no) }}">
                                            @error('student_no') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">AKTS</label>
                                        <input class="form-control" type="number" name="akts" value="{{ old('akts', @$material->akts) }}">
                                        @error('akts') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Kredi</label>
                                        <input class="form-control" type="number" name="kredi" value="{{ old('kredi', @$material->kredi) }}">
                                        @error('kredi') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('materials.show') }}"
                                    class="btn btn-light m-0">Cancel</a>
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
