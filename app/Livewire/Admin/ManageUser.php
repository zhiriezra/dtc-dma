<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUser extends Component
{
    use WithPagination;

    public $name;
    public $email;
    public $password;
    public $role_id;
    public $is_active = true;
    public $editingUserId = null;
    public $search = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'role_id' => 'required|exists:roles,id',
        'is_active' => 'boolean'
    ];

    public function mount()
    {
        $this->role_id = Role::where('slug', 'dsp')->first()->id;
    }

    public function createUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role_id' => $this->role_id,
            'is_active' => $this->is_active
        ]);

        $this->reset(['name', 'email', 'password', 'is_active']);
        session()->flash('message', 'DSP account created successfully.');
    }

    public function editUser($userId)
    {
        $user = User::find($userId);
        $this->editingUserId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role_id = $user->role_id;
        $this->is_active = $user->is_active;
    }

    public function updateUser()
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $this->editingUserId,
            'role_id' => 'required|exists:roles,id',
            'is_active' => 'boolean'
        ];

        if ($this->password) {
            $rules['password'] = 'min:6';
        }

        $this->validate($rules);

        $user = User::find($this->editingUserId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'is_active' => $this->is_active
        ]);

        if ($this->password) {
            $user->update(['password' => bcrypt($this->password)]);
        }

        $this->reset(['name', 'email', 'password', 'role_id', 'is_active', 'editingUserId']);
        session()->flash('message', 'DSP account updated successfully.');
    }

    public function toggleStatus($userId)
    {
        $user = User::find($userId);
        $user->update(['is_active' => !$user->is_active]);
        session()->flash('message', 'DSP account status updated successfully.');
    }

    public function render()
    {
        $users = User::where('role_id', Role::where('slug', 'dsp')->first()->id)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        return view('livewire.admin.manage-user', [
            'users' => $users
        ]);
    }
}
