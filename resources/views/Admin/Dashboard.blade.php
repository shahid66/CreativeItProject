@extends('layouts.Starlight')

@section('dashboard')
active
@endsection
@section('title')
dashbord
@endsection
@section('content')
<section>
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
          <a class="breadcrumb-item" href="{{ url('/home2') }}">Home</a>


        </nav>

        <div class="sl-pagebody">
            <div class="row ">

                <div class="col-md-8 ">
                    <div class="card">
                        <div class="card-head text-center">
                            <h3>All Users</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($AllUser as $key=>$item)
                                    <tr>
                                        <th scope="row">{{ $AllUser->firstItem()+$key }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td><img width="80" src="{{ asset('uploads/users') }}/{{ $item->photo }}" alt=""></td>
                                        <td>
                                            @php
                                                if($item->role==1){
                                                    echo "Admin";
                                                }else if($item->role==2){
                                                    echo "Mod";
                                                }else if($item->role==3){
                                                    echo "Editor";
                                                }else if($item->role==4){
                                                    echo "Shopkeeper";
                                                }else{
                                                    echo "Not Assign";
                                                }
                                            @endphp
                                        </td>
                                        <td>{{ $item->created_at->diffInHours() >24?$item->created_at->format('d/m/y h:i:s A'):$item->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a class="btn btn-danger deleteBtn" href="{{route('user.delete',$item->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach


                                </tbody>

                            </table>
                            {{ $AllUser->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-head text-center">
                            <h2>Add Users</h2>
                        </div>
                        <div class="card-body">

                            <form action="{{ url('/add/users') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control">

                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="role" class="form-control">
                                        <option value="">--SELECT--</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Mod</option>
                                        <option value="3">Editor</option>
                                        <option value="4">ShopKeeper</option>
                                    </select>
                                    @error('role')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                <button type="submit">Add User</button>
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
@section('footer_script')
<script>

    const deletebtns = document.querySelectorAll(".deleteBtn");

    deletebtns.forEach(function (btn) {

        const href = btn.getAttribute('href');

        btn.addEventListener('click', function (event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            })
        })
    })
</script>

@if (session('user_add'))
<script>
        const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: '{{ session('user_add') }}'
})
</script>

{{-- <script>
    $('#deleteBtn').click(function(){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                var url=''
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
    })

</script> --}}

@endif

@endsection
