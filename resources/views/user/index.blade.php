@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>
    <div class="mb-1">
        <a href="{{ route('user_create') }}" class="btn btn-outline-primary">
            <i class="fa fa-plus"></i> Add User
        </a>
    </div>
    <!-- DataTales Example -->
    @if (Session::has('message'))
        <div class="alert alert-success">
            {!! session('message') !!}
        </div>
    @endif
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">User List</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Avatar</th>
                <th>Role</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $key => $user)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <img src="{{ asset($user->avatar) }}" alt="{{$user->avatar}}" class="img-fluid" width="80">
                    </td>
                    <td>
                      @php
                          $org = \App\Organization::where('id', $user->organization_id)->first();
                      @endphp
                      @if ($user->role_id === 1)
                          <div class="badge badge-success">Admin</i>
                      @elseif ($user->role_id === 2)
                          <div class="badge badge-info">Account Manager</div><i> dari {{ $org->name }}</i>
                      @elseif ($user->role_id === 3)
                          <div class="badge badge-primary">Staff</div><i> dari {{ $org->name }}</div><i></i>
                      @endif
                    </td>
                    <td>
                        @if ($user->role_id !== 1)
                          <a href="{{ route('user_update', $user->id) }}" class="btn btn-primary btn-circle btn-sm">
                              <i class="fa fa-edit"></i>
                          </a>
                          <button data-toggle="modal" data-target="#delete{{ $user->id }}" class="btn btn-danger btn-circle btn-sm">
                              <i class="fa fa-trash"></i>
                          </button>
                        @else 
                          <div class="badge badge-success">Readonly</div>
                        @endif
                    </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="delete{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Delete PIC <strong>{{ $user->name }}</strong> ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{ route('user_destroy', $user->id) }}" class="btn btn-primary">Yes, Delete</a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

</div>
@endsection