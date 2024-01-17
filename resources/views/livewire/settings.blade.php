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
                        <div class="card card-success">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Invetory Code</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                @if (session()->has('messagescodeinventory'))
                                    <div class="pt-3 ">
                                        <div class="container-fluid alert alert-success alert-dismissible fade show"
                                            role="alert" style="opacity: .5">
                                            {{ session('messagescodeinventory') }}
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
                                                <th>Inventory name</th>
                                                <th>Details</th>
                                                <th>Inventory Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allCodeInventory as $key => $itemInventory)
                                                <tr>
                                                    <td>{{ $allCodeInventory->firstItem() + $key }}</td>
                                                    <td>{{ $itemInventory->name_inventory }}</td>
                                                    <td>{{ $itemInventory->details }}</td>
                                                    <td>{{ $itemInventory->inventory_code }}</td>
                                                    <td>
                                                        <span type="button"
                                                            wire:click="editinventory({{ $itemInventory->id }})"
                                                            class="badge badge-warning">Edit</span>
                                                        <span type="button" class="badge badge-danger"
                                                            wire:click="delete({{ $itemInventory->id }})">Delete</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $allCodeInventory->links() }}
                                    <div class="pt-3">
                                    </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                    <div class="col-lg-4">
                        <div class="card card-{{ $updateDataInventory == true ? 'warning' : 'success' }}">
                            <div class="card-header border-transparent">
                                @if ($updateData == true)
                                    <h3 class="card-title">Edit Inventory Code</h3>
                                @else
                                    <h3 class="card-title">Make Inventory Code</h3>
                                @endif
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body p-0">
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Inventory Name</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter name" wire:model='name_inventory'>
                                            @error('name_inventory')
                                                <p class="alert alert-danger alert-dismissible">Must Not Empty
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Details</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter name" wire:model="details">
                                            @error('details')
                                                <p class="alert alert-danger alert-dismissible">Must Not Empty
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Inventory Code</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter Inventory Code" wire:model="inventory_code">
                                            @error('inventory_code')
                                                <p class="alert alert-danger alert-dismissible">Must Not Empty
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </p>
                                            @enderror
                                        </div>
                                        @php
                                            $code = $inventory_code;
                                        @endphp
                                        @if ($code)
                                            {!! DNS1D::getBarcodeHTML($code, 'CODABAR') !!}
                                            <label for="name">{{ $inventory_code }}</label>
                                        @endif
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        @if ($updateDataInventory == true)
                                            <button type="button" class="btn btn-warning"
                                                wire:click="update">Update</button>
                                        @else
                                            <button type="button" class="btn btn-primary"
                                                wire:click="storeinventorycode">Add</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-secondary card-collapse">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Location Code</h3>

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
                                @if (session()->has('messagescodelocation'))
                                    <div class="pt-3">
                                        <div class="container-fluid alert alert-success alert-dismissible fade show"
                                            role="alert">
                                            {{ session('messagescodelocation') }}
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
                                                <th>Location Codes</th>
                                                <th>Details</th>
                                                <th>Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allLocationCodes as $key => $itemLocationCode)
                                                <tr>
                                                    <td>{{ $allLocationCodes->firstItem() + $key }}</td>
                                                    <td>{{ $itemLocationCode->name_location }}</td>
                                                    <td>{{ $itemLocationCode->details_location }}</td>
                                                    <td>{{ $itemLocationCode->location_code }}</td>
                                                    <td>
                                                        <span type="button"
                                                            wire:click="editLocCode({{ $itemLocationCode->id }})"
                                                            class="badge badge-warning">Edit</span>
                                                        <span type="button" class="badge badge-danger"
                                                            wire:click="deleteLocCode({{ $itemLocationCode->id }})">Delete</span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="pt-3">
                                        {{ $allLocationCodes->links() }}
                                    </div>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-{{ $updateData == true ? 'warning' : 'secondary' }}">
                            <div class="card-header border-transparent">
                                @if ($updateData == true)
                                    <h3 class="card-title">Edit Location Code</h3>
                                @else
                                    <h3 class="card-title">Add Location Code</h3>
                                @endif
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
                            <!-- form start -->
                            <div class="card-body p-0">
                                <form>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Location Name</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter name" wire:model="name_location">
                                            @error('name_location')
                                                <p class="alert alert-danger alert-dismissible">Must Not Empty
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="details">Details</label>
                                            <input type="text" class="form-control" id="details_location"
                                                placeholder="Enter details" wire:model="details_location">
                                            @error('details_location')
                                                <p class="alert alert-danger alert-dismissible">Must Not Empty
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </p>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="locationcode">Code Location</label>
                                            <input type="text" class="form-control" id="location_code"
                                                placeholder="Enter Location Code" wire:model="location_code">
                                            @error('location_code')
                                                <p class="alert alert-danger alert-dismissible">Must Not Empty
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </p>
                                            @enderror
                                        </div>
                                        @php
                                            $code = $location_code;
                                        @endphp
                                        @if ($code)
                                            {!! DNS1D::getBarcodeHTML($location_code, 'CODABAR') !!}
                                            <label for="name">{{ $location_code }}</label>
                                        @endif
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        @if ($updateDataLocationCode == true)
                                            <button type="button" class="btn btn-warning"
                                                wire:click="updateLocationCode">Update</button>
                                        @else
                                            <button type="button" class="btn btn-primary"
                                                wire:click="storelocationcode">Add</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-{{ $updateLogo == true ? 'warning' : 'danger' }}">
                            <div class="card-header border-transparent">
                                @if ($updateLogo == true)
                                    <h3 class="card-title">Edit Logo Barcode</h3>
                                @else
                                    <h3 class="card-title">Logo Barcode</h3>
                                @endif
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <center>
                                @if ($barcodelogo->isEmpty())
                                    <h2>NO LOGO PRESENT</h2>
                                @else
                                    @foreach ($barcodelogo as $item)
                                        <div class="p-3">
                                            <img src="storage/barcode_logo/{{ $item->file_name }}" alt="logo">
                                        </div>
                                    @endforeach

                                @endif
                            </center>
                            <div class="card-footer">
                                @if ($updateLogo == true)
                                    <button type="button" class="btn btn-dark"
                                        wire:click="clearLogo">Cancel</button>
                                @else
                                    <button type="submit" class="btn btn-warning"
                                        wire:click="editLogo">Edit</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card card-{{ $updateLogo == true ? 'warning' : 'danger' }}">
                            <div class="card-header border-transparent">
                                @if ($updateLogo == true)
                                    <h3 class="card-title">Edit Logo Barcode</h3>
                                @else
                                    <h3 class="card-title">Logo Barcode</h3>
                                @endif
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
                            <!-- form start -->
                            @if ($barcodelogo->isEmpty())
                                <div class="card-footer">
                                    <button type="button" class="btn btn-warning" wire:click="addlogo">Add
                                        Logo</button>
                                </div>
                            @endif
                            <div class="card-body p-3">
                                @if ($statelogo == true)
                                    <form wire:submit="barcodeLogoAdd">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="name_logo">Logo Name</label>
                                                <input type="text" class="form-control" id="name_logo"
                                                    placeholder="Enter name" wire:model="name_logo">
                                                @error('name_logo')
                                                    <p class="alert alert-danger alert-dismissible">Must Not Empty
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="details">Details</label>
                                                <input type="text" class="form-control" id="details_logo"
                                                    placeholder="Enter details" wire:model="details_logo">
                                                @error('details_logo')
                                                    <p class="alert alert-danger alert-dismissible">Must Not Empty
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleFormControlFile1">Choose file</label>
                                                <input type="file" class="form-control-file"
                                                    id="exampleFormControlFile1" wire:model="file_name"
                                                    value="image">
                                            </div>
                                            @if ($file_name)
                                                <h5>Preview</h5>
                                                <img src="{{ $file_name->temporaryUrl() }}" width="100px">
                                            @endif
                                        </div>
                                        @if ($barcodelogo->isEmpty())
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-warning"
                                                    wire:click=" barcodeLogoAdd">Submit Logo</button>
                                            </div>
                                        @endif

                                        @if ($updateLogo == true)
                                            <div class="card-footer">
                                                <button type="button" class="btn btn-dark"
                                                    wire:click="clearLogo">Cancel</button>
                                                <button type="submit" class="btn btn-warning"
                                                    wire:click="updateLogo">Update</button>
                                            </div>
                                        @endif
                                        <!-- /.card-body -->
                                    </form>

                                @endif

                            </div>
                        </div>
                    </div>
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
