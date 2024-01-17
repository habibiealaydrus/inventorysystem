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
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Stock in warehouse</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                    class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>

                    <!-- /.card-header -->
                    @if (Auth::user()->name == 'admin')
                        <div class="col-md-6 p-3">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                Add Stock
                            </button>
                        </div>
                        <!-- Modal -->
                        <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="date">Date</label>
                                                    <input type="date" class="form-control" id="date"
                                                        placeholder="Enter Date Item" wire:model='date_inventory'>
                                                </div>
                                                @error('date_inventory')
                                                    <p class="alert alert-danger"> cannot be empty</p>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="type">Type</label>
                                                    <select class="form-control" name="type" id="type"
                                                        wire:model='asset_type'>
                                                        @foreach ($assettype as $item)
                                                            <option value="{{ $item->name_asset }}">
                                                                {{ $item->name_asset }}
                                                            </option>
                                                        @endforeach
                                                        <option value="1"> Test</option>
                                                    </select>
                                                </div>
                                                @error('asset_type')
                                                    <p class="alert alert-danger"> cannot be empty</p>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="name_inventory">Name Inventory</label>
                                                    <input type="name_inventory" class="form-control"
                                                        id="name_inventory" placeholder="input name inventory"
                                                        wire:model='name_inventory'>
                                                </div>
                                                @error('name_inventory')
                                                    <p class="alert alert-danger"> cannot be empty</p>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="name_inventory">Code Inventory</label>
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <select name="inventory_code" style="width:100%;height:100%"
                                                                class=" inventory_code_master "
                                                                wire:model='code_inventory_master'>
                                                                @foreach ($inventorycode as $key => $itemcode)
                                                                    <option value="{{ $itemcode->inventory_code }}">
                                                                        {{ $itemcode->inventory_code }}-{{ $itemcode->name_inventory }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="text" class="form-control"
                                                                wire:model='code_inventory_order'>
                                                            @error('code_inventory_order')
                                                                <p class="alert alert-danger"> cannot be empty</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="type_quantity">Type Quantity</label>
                                                    <input type="text" class="form-control" id="type_quantity"
                                                        placeholder="Type Input Quantity" wire:model='type_quantity'>
                                                </div>
                                                @error('type_quantity')
                                                    <p class="alert alert-danger"> cannot be empty</p>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="quantity">Quantity</label>
                                                    <input type="mumber" class="form-control" id="quantity"
                                                        placeholder="Input quantity" wire:model='quantity'>
                                                </div>
                                                @error('quantity')
                                                    <p class="alert alert-danger"> cannot be empty</p>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="photo_product">Photo product</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="photo_product" wire:model='photo_product'>
                                                            <label class="custom-file-label" for="photo_product">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('photo_product')
                                                    <p class="alert alert-danger"> cannot be empty</p>
                                                @enderror
                                                <div class="form-group">
                                                    <label for="photo_recieve">Photo Recieve</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input"
                                                                id="photo_recieve" wire:model='photo_recieve'>
                                                            <label class="custom-file-label"
                                                                for="photo_recieve">Choose
                                                                file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('photo_recieve')
                                                    <p class="alert alert-danger"> cannot be empty</p>
                                                @enderror
                                            </div>
                                            <div class="card-footer">
                                                <button type="button" wire:click="storeInInventory"
                                                    class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    wire:click="clear">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="card-body p-3">
                        <table id="stock" class="table table-bordered " style="width:100%;">
                            <thead>
                                <tr>
                                    <td rowspan="2" class="align-middle text-center font-weight-bold">Date</td>
                                    <td rowspan="2" class="align-middle text-center font-weight-bold">Name Product
                                    </td>
                                    <td rowspan="2" class="align-middle text-center font-weight-bold">Inventory
                                        Code
                                    </td>
                                    <td rowspan="2" class="align-middle text-center font-weight-bold">Type Stock
                                    </td>
                                    <td rowspan="2" class="align-middle text-center font-weight-bold">Type Quantity
                                    </td>
                                    <td colspan="6" class="align-middle text-center font-weight-bold">Stock</td>
                                </tr>
                                <tr>
                                    <td class="align-middle text-center font-weight-bold">IN</td>
                                    <td class="align-middle text-center font-weight-bold">OUT</td>
                                    <td class="align-middle text-center font-weight-bold">In Stock</td>
                                    <td class="align-middle text-center font-weight-bold">Photo Product</td>
                                    <td class="align-middle text-center font-weight-bold">Receive Photo</td>
                                    <td class="align-middle text-center font-weight-bold">Action</td>
                                </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>07/12/2023</td>
                                    <td>Table work</td>
                                    <td>0003030890</td>
                                    <td>Asset Stationery</td>
                                    <td>Pieces</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>1 </td>
                                    <td>Photo Product</td>
                                    <td>Photo proof</td>
                                    <td>
                                        <button class="btn btn-success"> Print Label</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    $('.inventory_code_master').chosen({
        // Chosen options here
    });
</script>
