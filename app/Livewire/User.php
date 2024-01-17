<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class User extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name;
    public $email;
    public $address;
    public $level;
    public $password;
    public $photo;
    public $updateData = false;
    public $id_user;

    public function store()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'level' => 'required',
            'photo' => 'required|image|max:1024',
            'password' => 'required|min:6',
        ];
        $messages = [
            'name.required' => 'name field not be empty',
            'email.required' => 'email field not be empty',
            'email.email' => 'email format not right',
            'address.required' => 'address field not be empty',
            'photo.required' => 'photo field not be empty',
            'image.max:1024' => 'image not more 1 MB',
            'password.required' => 'password field not be empty',
            'name.min:6' => 'minimum 6 character',
        ];
        $validated = $this->validate($rules, $messages);
        $photo =  $this->name . '.jpeg';
        ModelsUser::create(
            [
                'name' => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'level' => $this->level,
                'password' => $this->password,
                'photo' => $photo,
            ]
        );
        $this->photo->storeAs('photo_profile', $photo, 'public');
        session()->flash('messages', 'data added');
        $this->clear();
    }
    public function clear()
    {
        $this->name = '';
        $this->email = '';
        $this->address = '';
        $this->level = '';
        $this->password = '';
        $this->updateData = false;
    }
    public function edit($id)
    {
        $dataUser = ModelsUser::find($id);


        $this->name = $dataUser->name;
        $this->email = $dataUser->email;
        $this->address = $dataUser->address;
        $this->level = $dataUser->level;
        $this->photo = $dataUser->photo;
        $this->password = $dataUser->password;
        $this->updateData = true;
        $this->id_user = $id;
    }
    public function update()
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'photo' => 'required',
            'level' => 'required',
            'password' => 'required|min:6',
        ];
        $messages = [
            'name.required' => 'name field not be empty',
            'email.required' => 'email field not be empty',
            'email.email' => 'email format not right',
            'address.required' => 'address field not be empty',
            'photo.required' => 'must choose photo',
            'password.required' => 'password field not be empty',
            'name.min:6' => 'minimum 6 character',
        ];
        $validated = $this->validate($rules, $messages);
        $data = ModelsUser::find($this->id_user);
        $photo =  $this->name . '.jpeg';
        $data->update(
            [
                'name' => $this->name,
                'email' => $this->email,
                'address' => $this->address,
                'level' => $this->level,
                'password' => $this->password,
                'photo' => $photo,
            ]
        );
        $this->photo->storeAs('photo_profile', $photo, 'public');
        session()->flash('messages', 'data updated');
        $this->clear();
    }

    public function delete($id)
    {
        $deletedItem = ModelsUser::find($id);
        $deletedPhoto = public_path('storage/photo_profile/' . $deletedItem->photo);
        //dd($deletedPhoto);
        if (file_exists($deletedPhoto)) {
            unlink($deletedPhoto);
        }

        $deletedItem->delete($id);
        $this->clear();
    }

    public function render()
    {
        $allUser = ModelsUser::orderBy('id', 'desc')->paginate(10);
        //dd($allUser->toArray());
        return view('livewire.user', ['allUser' => $allUser]);
    }
}
