@extends('layouts.app')

@section('content')
<div class="container-fluid">

        <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Organization</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Organization</h6>
      </div>
      <div class="card-body">
        <form action="{{ route('organization_process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                        <strong class="text-danger">{!! $errors->first('name', '<p class="help-block">:message</p>') !!}</strong>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? 'has-error' : ''}}">
                        <label>Phone</label>
                        <input type="number" name="phone" class="form-control">
                        <strong class="text-danger">{!! $errors->first('phone', '<p class="help-block">:message</p>') !!}</strong>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? 'has-error' : ''}}">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control">
                        <strong class="text-danger">{!! $errors->first('email', '<p class="help-block">:message</p>') !!}</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('website') ? 'has-error' : ''}}">
                        <label>Website</label>
                        <input type="text" name="website" class="form-control">
                        <strong class="text-danger">{!! $errors->first('website', '<p class="help-block">:message</p>') !!}</strong>
                    </div>
                    <div class="form-group{{ $errors->has('avatar') ? 'has-error' : ''}}">
                        <label>Logo</label>
                        <input type="file" class="form-control" name="logo">
                        <strong class="text-danger">{!! $errors->first('logo', '<p class="help-block">:message</p>') !!}</strong>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>
      </div>
    </div>

</div>
@endsection