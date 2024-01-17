<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Inventorycode;
use App\Models\Locationcode;
use App\Models\Logobarcode;
use Livewire\WithFileUploads;


class Settings extends Component
{
    use WithFileUploads;
    use WithPagination;
    //protected $errorBag = 'storeinventorycode';

    protected $paginationTheme = 'bootstrap';

    public $statelogo = false;
    public $name_inventory;
    public $details;
    public $inventory_code;
    public $updateDataInventory = false;
    public $updateData = false;
    public $id_codeInventory;



    public $updateDataLocationCode = false;
    public $name_location;
    public $details_location;
    public $location_code;
    public $id_codeLocation;


    public $updateLogo = false;
    public $name_logo;
    public $details_logo;
    public $file_name;

    public function clear()
    {
        $this->name_inventory = '';
        $this->details = '';
        $this->inventory_code = '';
        $this->updateDataInventory = false;
        $this->error;
    }
    public function clearLocCode()
    {
        $this->updateDataLocationCode = false;
        $this->name_location = '';
        $this->details_location = '';
        $this->location_code = '';
        $this->id_codeLocation = '';
    }
    public function storeinventorycode()
    {

        $rules = [
            'name_inventory' => 'required',
            'details' => 'required',
            'inventory_code' => 'required|unique:inventorycodes',
        ];
        $messagesinventorycode = [
            'name_inventory.required' => 'itumasih kosong dongo',
            'details.required' => 'itu masih kosong dongo',
            'inventory_code.required' => 'itumasih kosong dongo',
        ];
        $validated = $this->validate($rules, $messagesinventorycode);
        // dd($validated);
        Inventorycode::create($validated);
        session()->flash('messagescodeinventory', 'data added');
        $this->clear();
    }
    public function editinventory($id)
    {
        $codeInventory = Inventorycode::find($id);
        $this->name_inventory = $codeInventory->name_inventory;
        $this->details = $codeInventory->details;
        $this->inventory_code = $codeInventory->inventory_code;
        $this->updateDataInventory = true;
        $this->id_codeInventory = $id;
    }
    public function update()
    {
        $rules = [
            'name_inventory' => 'required',
            'details' => 'required',
            'inventory_code' => 'required',
        ];
        $validated = $this->validate($rules);
        $data = Inventorycode::find($this->id_codeInventory);
        $data->update($validated);
        session()->flash('messagescodeinventory', 'data updated');
        $this->clear();
    }
    public function delete($id)
    {
        Inventorycode::find($id)->delete();
        $this->clear();
    }
    public function storelocationcode()
    {

        $rules = [
            'name_location' => 'required',
            'details_location' => 'required',
            'location_code' => 'required|unique:locationcodes',
        ];
        $validated = $this->validate($rules)->validateWithBag('storelocationcode');
        // dd($validated);
        Locationcode::create($validated);
        session()->flash('messagescodelocation', 'data added');
        $this->clear();
    }
    public function deleteLocCode($id)
    {
        Locationcode::find($id)->delete();
        $this->clear();
    }
    public function editLocCode($id)
    {

        $codeLocCode = Locationcode::find($id);
        // dd($codeLocCode);
        $this->updateDataLocationCode = true;
        $this->name_location = $codeLocCode->name_location;
        $this->details_location = $codeLocCode->details_location;
        $this->location_code = $codeLocCode->location_code;
        $this->id_codeLocation = $id;
    }
    public function addlogo()
    {
        $this->statelogo = true;
    }
    public function clearLogo()
    {
        $this->name_logo = '';
        $this->details_logo = '';
        $this->file_name = '';
        $this->updateLogo = false;
        $this->statelogo = false;
    }
    public function barcodeLogoAdd()
    {
        $rulesLogo = [
            'name_logo' => 'required',
            'details_logo' => 'required',
            'file_name' => 'required'
        ];
        $this->validate($rulesLogo);
        $filename =  $this->name_logo . '.jpeg';
        Logobarcode::create(
            [
                'name_logo' => $this->name_logo,
                'details_logo' => $this->details_logo,
                'file_name' => $filename,
            ]
        );
        $this->file_name->storeAs('barcode_logo', $filename, 'public');
        session()->flash('messages', 'data added');
        $this->clearLogo();
    }
    public function editLogo()
    {
        $this->updateLogo = true;
        $this->statelogo = true;
    }
    public function render()
    {
        $allLocationCodes = Locationcode::orderBy('id', 'desc')->paginate(10);
        $allCodeInventory = Inventorycode::orderBy('id', 'desc')->paginate(10);
        $barcodelogo = Logobarcode::orderBy('id', 'asc')->paginate(1);


        //dd($barcodelogo);
        return view(
            'livewire.settings',
            [
                'allCodeInventory' => $allCodeInventory,
                'allLocationCodes' => $allLocationCodes,
                'barcodelogo' => $barcodelogo
            ]
        );
    }
}
