@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Materials'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Materials</h5>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href="{{ route('materials.create') }}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp;
                                    New Materials</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-0">
                    <form method="GET" action="{{ route('materials.show') }}" enctype="multipart/form-data">
                        <div class="card-body row">
                            <div class="form-group col-7">
                                <input class="form-control" type="text" name="search_title" id="search_title"
                                    placeholder="Search Title" value="{{ request('search_title') }}">
                            </div>
                            <div class="form-group col-5 ">
                                <button type="submit" class="btn btn-primary">Search</button>
                                <a href="{{ route('materials.show') }}" class="btn btn-light">Clear</a>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            {{-- <div class="dataTable-top">
                                <div class="dataTable-search">
                                    <input class="dataTable-input" placeholder="Search..."
                                        type="text">
                                </div>
                            </div> --}}
                            <div class="dataTable-container">
                                <table class="table table-flush dataTable-table" id="users-list">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 30%;">Name</th>
                                            <th style="width: 25%;">Student Number</th>
                                            <th style="width: 15%;">AKTS</th>
                                            <th style="width: 15%;">Kredi</th>
                                            <th style="width: 15%;">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($materials as $material)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <h6 class="ms-3 my-auto">{{ @$material->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-sm">{{ @$material->student_no }}</td>
                                                <td class="text-sm">{{ @$material->akts }}</td>
                                                <td class="text-sm">{{ @$material->kredi }}</td>
                                                <td class="text-sm">
                                                    <div class="row">

                                                        @role('Super-Admin')
                                                            <div class="col-2">
                                                                <a href="{{ route('materials.edit', @$material->id) }}"
                                                                    class="" data-bs-toggle="tooltip"
                                                                    data-bs-original-title="Edit aid">
                                                                    <i class="fas fa-user-edit text-secondary"
                                                                        aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                        @endrole

                                                        @role('Super-Admin')
                                                            <div class="col-2">
                                                                <form action="{{ route('materials.delete', @$material->id) }}"
                                                                    method="POSt">
                                                                    @csrf
                                                                    <a data-bs-toggle="tooltip"
                                                                        data-bs-original-title="Delete aid">
                                                                        <button type="submit"
                                                                            style="background: none; border: none;"><i
                                                                                class="fas fa-trash text-secondary"
                                                                                aria-hidden="true"></i></button>
                                                                    </a>
                                                                </form>
                                                            </div>
                                                        @endrole
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>

                            @if ($materials->isNotEmpty() && $materials->hasPages())
                                {{ $materials->links('pages.materials.partials.pagination', ['entries' => @$materials]) }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
@endsection
