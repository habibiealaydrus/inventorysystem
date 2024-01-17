<div>
    <!-- Navbar -->
    @include('layout.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('layout.sidemenu')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @include('layout.contentheader')
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-info p-2">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">List Users</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                @if (session()->has('messages'))
                                    <div class="pt-3">
                                        <div class="container-fluid alert alert-success alert-dismissible fade show"
                                            role="alert">
                                            {{ session('messages') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Level</th>
                                                <th>Photo</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allUser as $key => $user)
                                                <tr>
                                                    <td>{{ $allUser->firstItem() + $key }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->address }}</td>
                                                    <td>{{ $user->level }}</td>
                                                    <td> <img src="storage/photo_profile/{{ $user->photo }}"
                                                            width="50px" height="50px" style=" border-radius: 50%;">
                                                    </td>
                                                    <td>
                                                        <span type="button" wire:click="edit({{ $user->id }})"
                                                            class="badge badge-warning">Edit</span>
                                                        <span type="button" class="badge badge-danger"
                                                            wire:click="delete({{ $user->id }})">Delete</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="pt-3">
                                        {{ $allUser->links() }}
                                    </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                        @include('layout.userpiechart')
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-4">
                        <div class="card card-{{ $updateData == true ? 'warning' : 'primary' }}">
                            <div class="card-header">
                                @if ($updateData == true)
                                    <h3 class="card-title">Edit User</h3>
                                @else
                                    <h3 class="card-title">Add User</h3>
                                @endif
                            </div>
                            @if ($errors->any())

                                <div class="container-fluid
                            alert alert-danger alert-dismissible fade show"
                                    role="alert">
                                    @foreach ($errors->all() as $item)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="currentColor"
                                            class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                            viewBox="0 0 16 16" role="img" aria-label="Warning:">
                                            <path
                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                        </svg>
                                        {{ $item }}
                                        <br>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Enter name" wire:model="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email"
                                            placeholder="Enter email" wire:model="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="address" class="form-control" id="address"
                                            placeholder="Enter address" wire:model="address">
                                    </div>
                                    <div class="form-group">
                                        <label for="level">level</label>
                                        <select class="form-control" id="level" name="level" wire:model="level">
                                            <option value="">Select your option</option>
                                            <option value="admin">admin</option>
                                            <option value="user">user</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo">Photo</label>
                                        <input type="file" wire:model="photo" class="form-control-file"
                                            id="photo" value="image">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="password"
                                            placeholder="Password" wire:model="password">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    @if ($updateData == true)
                                        <button type="button" class="btn btn-warning"
                                            wire:click="update">Update</button>
                                    @else
                                        <button type="button" class="btn btn-primary"
                                            wire:click="store">Add</button>
                                    @endif
                                    <button type="button" class="btn btn-dark" wire:click="clear">Clear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('layout.footer')
</div>
