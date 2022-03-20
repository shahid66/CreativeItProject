@extends('layouts.Starlight')

@section('title')
edit-Profile
@endsection
@section('content')
<section>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home2') }}">Home</a>


            <span class="breadcrumb-item active">Edit Profile</span>
        </nav>

        <div class="sl-pagebody">
    <div class="row ">

        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-head text-center">
                    <h3>Update Name</h3>
                </div>

                <div class="card-body">
                    @if (session('updateName'))
                <div class="alert alert-success">
                    {{ session('updateName') }}
                </div>
                @endif
                    <form action="{{ url('/profile/name/update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input name="user_id" value="{{ $userName->id }}" type="hidden" class="form-control" >

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Name</label>
                            <input name="name" value="{{ $userName->name }}" type="text" class="form-control" >
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-head text-center">
                    <h3>Update Password</h3>
                </div>
                <div class="card-body">
                    @if (session('password_update'))
                <div class="alert alert-success">
                    {{ session('password_update') }}
                </div>
                @endif
                @if (session('password_no_update'))
                <div class="alert alert-danger">
                    {{ session('password_no_update') }}
                </div>
                @endif
                    <form action="{{ url('/profile/password/update') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input name="user_id" value="{{ $userName->id }}" type="hidden" class="form-control" >

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Old Password</label>
                            <input name="old_password" type="text" class="form-control" >
                            @error('old_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input name="password" type="text" class="form-control" >
                            @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Confirmed Password</label>
                            <input name="password_confirmation" type="password" class="form-control" >

                          </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 m-auto">
            <div class="card">
                <div class="card-head text-center">
                    <h3>Update Image</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/profile/image/update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input name="cat_id" value="" type="hidden" class="form-control" >

                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Image</label>
                            <input name="image"  type="file" class="form-control" >
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                          </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary ">Update</button>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->
</section>
@endsection
