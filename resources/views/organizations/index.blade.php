@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Organization List</h1>
    <div class="row">
      <div class="col-md-1"></div>
      <div class="mb-3">
          <form class="form-inline" method="GET" action="{{ route('organization_list') }}">
            <label class="sr-only" for="inlineFormInputName2">Search</label>
            <input type="text" class="form-control mb-2 mr-sm-2" name="search" id="inlineFormInputName2" placeholder="Search" {% if Request::get('search') %} value="{{ Request::get('search') }}" {% endif %}>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
          </form>
      </div>
    </div>
    @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
      <div class="row">
        <div class="col-md-2">
          <div class="mb-3">
              <a href="{{ route('organization_add') }}" class="btn btn-primary">
                  <i class="fa fa-plus"></i> Add
              </a>
          </div>
        </div>
      </div>
    @endif
    @if (Session::has('message'))
        <div class="alert alert-success">
            {!! session('message') !!}
        </div>
    @endif
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Logo</th>
                <th>Options</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($organizations as $key => $organization)

                @if (Auth::user()->organization_id === 0 && Auth::user()->role_id === 1)
                  <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $organization->name }}</td>
                      <td>{{ $organization->phone }}</td>
                      <td>{{ $organization->email }}</td>
                      <td>
                          <img src="{{ url($organization->logo) }}" alt="{{$organization->logo}}" class="img-fluid" width="80">
                      </td>
                      <td>
                          <a href="{{ route('organization_edit', $organization->id) }}" class="btn btn-primary btn-circle btn-sm">
                              <i class="fa fa-edit"></i>
                          </a>
                          <a href="{{ route('organization_detail', $organization->id) }}" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                          <button data-toggle="modal" data-target="#deleteOrg{{ $organization->id }}" class="btn btn-danger btn-circle btn-sm">
                              <i class="fa fa-trash"></i>
                          </button>
                          
                      </td>
                  </tr>
                  <div class="modal fade" id="deleteOrg{{ $organization->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">{{ $organization->name }}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Apakah anda yakin ingin menghapus orgnisasi <strong>{{ $organization->name }}</strong> ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <a href="{{ route('organization_delete', $organization->id) }}" type="button" class="btn btn-primary">Ya, Hapus</a>
                        </div>
                      </div>
                    </div>
                  </div>
                @elseif (Auth::user()->organization_id === $organization->id && Auth::user()->role_id === 2)
                  <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $organization->name }}</td>
                      <td>{{ $organization->phone }}</td>
                      <td>{{ $organization->email }}</td>
                      <td>
                          <img src="{{ url($organization->logo) }}" alt="{{$organization->logo}}" class="img-fluid" width="80">
                      </td>
                      <td>
                        <a href="{{ route('organization_detail', $organization->id) }}" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                      </td>
                  </tr>
                @else
                  <tr>
                      <td>{{ $key+1 }}</td>
                      <td>{{ $organization->name }}</td>
                      <td>{{ $organization->phone }}</td>
                      <td>{{ $organization->email }}</td>
                      <td>
                          <img src="{{ url($organization->logo) }}" alt="{{$organization->logo}}" class="img-fluid" width="80">
                      </td>
                      <td>
                        <a href="{{ route('organization_detail', $organization->id) }}" class="btn btn-primary btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                      </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection