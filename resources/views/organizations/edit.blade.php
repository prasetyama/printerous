@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Organization</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Organization</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('organization_update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="hidden" name="id" value="{{ $organization->id }}">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $organization->name }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="number" name="phone" value="{{ $organization->phone }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" value="{{ $organization->email }}" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" name="website" value="{{ $organization->website }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Logo</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-upload-preview">
                                    <img src="{{ url($organization->logo) }}" alt="" width="200" class="img-responsive">
                                </div>
                                <input type="file" class="form-control" name="logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success">Update</button>
        </form>
      </div>
    </div>

</div>
@endsection