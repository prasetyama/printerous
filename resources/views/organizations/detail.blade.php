@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Organization Detail</h1>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table>
                <tr>
                    <th>Name</th>
                    <td>: {{ $organization->name }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>: {{ $organization->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>: {{ $organization->email }}</td>
                </tr>
                <tr>
                    <th>Webiste</th>
                    <td>: {{ $organization->website }}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>: {{ date('d M Y H:i:s', strtotime($organization->created_at)) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <h3 class="h3 mb-2 text-gray-800">PIC</h3>
    @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
      <div class="row">
        <div class="col-md-2">
          <div class="mb-3">
              <a href="{{ route('user_create') }}" class="btn btn-primary">
                  <i class="fa fa-plus"></i> Add
              </a>
          </div>
        </div>
      </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm"  id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organization->users as $key => $user)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->role_id === 1)
                                                <div class="badge badge-success">Admin</div>
                                            @elseif ($user->role_id === 2)
                                                <div class="badge badge-info">Account Manager</div>
                                            @elseif ($user->role_id === 3)
                                                <div class="badge badge-warning">Staff</div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection