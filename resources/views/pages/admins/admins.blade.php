@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Employees'])
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-lg-flex">
                            <div>
                                <h5 class="mb-0">Employees</h5>
                            </div>
                            <div class="ms-auto my-auto mt-lg-0 mt-4">
                                <div class="ms-auto my-auto">
                                    <a href="{{ route('admins.create') }}" class="btn bg-gradient-primary btn-sm mb-0">+&nbsp; New Employee</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-0">
                        <div class="table-responsive">
                            <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                                <div class="dataTable-container">
                                    <table class="table table-flush dataTable-table" id="users-list">
                                        <thead class="thead-light">
                                            <tr>
                                                <th style="width: 34.4984%;">Name</th>
                                                <th style="width: 13.5043%;">Email</th>
                                                <th style="width: 11.2347%;">Role</th>
                                                <th style="width: 14.8661%;">Create Date</th>
                                                <th style="width: 11.2347%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach (@$admins as $admin)
                                            <tr>
                                                <td>
                                                    <div class="d-flex">
                                                        <img class="w-10 ms-3"
                                                            src="{{ asset('img/default.jpg') }}"
                                                            alt="hoodie">
                                                        <h6 class="ms-3 my-auto">{{ @$admin->firstname }} {{ @$admin->lastname }}</h6>
                                                    </div>
                                                </td>
                                                <td class="text-sm">{{ @$admin->email }}</td>
                                                <td class="text-sm">{{ @$admin->getRoleNames()[0] }}</td>
                                                <td class="text-sm">{{ @$admin->updated_at->format('d/m/Y') }}</td>
                                                <td class="text-sm">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <a href="{{ route('admins.edit', @$admin->username) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit admin">
                                                                <i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-6">
                                                            <form action="{{ route('admins.delete', @$admin->username) }}" method="POSt">
                                                                @csrf
                                                                <a data-bs-toggle="tooltip" data-bs-original-title="Delete user">
                                                                    <button type="submit"  style="background: none; border: none;"><i class="fas fa-trash text-secondary" aria-hidden="true"></i></button>
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                @if ($admins->isNotEmpty() && $admins->hasPages())
                                    {{ $admins->links('pages.materials.partials.pagination', ['entries' => @$admins]) }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection
