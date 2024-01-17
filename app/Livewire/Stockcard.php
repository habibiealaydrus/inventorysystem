<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Assettype;
use App\Models\Inventorycode;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Models\Inventorytransaction;

class Stockcard extends Component
{
    use WithFileUploads;

    public $name_stock;
    public $date_inventory;
    public $type_asset;
    public $name_inventory;
    public $code_inventory;
    public $code_inventory_order;
    public $type_inventory;
    public $quantity_type;
    public $quantity;
    public $photo_product;
    public $photo_recieve;
    public $type_transaction;

    public function add()
    {
        $this->type_transaction = 'in';
    }
    public function storeInInventory()
    {
        $rules = [
            'name_stock' => 'required',
            'date_inventory' => 'required',
            'type_asset' => 'required',
            'name_inventory' => 'required',
            'code_inventory' => 'required',
            'code_inventory_order' => 'required',
            'type_inventory' => 'required',
            'quantity_type' => 'required',
            'quantity' => 'required',
            'photo_product' => 'required',
            'photo_recieve' => 'required',
            'type_transaction' => 'required'
        ];
        $validated = $this->validate($rules);
        Inventorytransaction::create(
            [
                'date' => $this->date_inventory,
                'type_asset' => $this->type_asset,
                'name_inventory' => $this->name_inventory,
                'code_inventory' => $this->code_inventory_master . '-' . $this->code_inventory_order,
                'type_inventory' => $this->type_inventory,
                'quantity_type' => $this->quantity_type,
                'quantity' => $this->quantity,
                'photo_product' => $this->photo_product,
                'photo_recieve' => $this->photo_recieve,
                'type_transaction' => 'in'
            ]
        );
        $this->name_inventory->storeAs('photo_product', $this->name_inventory, 'public/stockphoto');
        session()->flash('messagescodeinventory', 'Stock has been added');
        $this->clear();
    }
    public function clear()
    {

        $this->name_stock = '';
        $this->date_inventory = '';
        $this->type_asset = '';
        $this->name_inventory = '';
        $this->code_inventory = '';
        $this->type_inventory = '';
        $this->quantity_type = '';
        $this->quantity = '';
        $this->photo_product = '';
        $this->photo_recieve = '';
        $this->type_transaction = '';
    }



    public function render()
    {
        $inventorycode = DB::table('inventorycodes')->get();
        $assettype = Assettype::all();
        return view(
            'livewire.stockcard',
            [
                'assettype' => $assettype,
                'inventorycode' => $inventorycode
            ]
        );
    }
}
