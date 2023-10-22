<?php

namespace App\Http\Livewire;

use App\Models\empleado;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class AdminUserList extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $search;
    public $tipoUsuario;
    public $select=[];
    protected $listeners = 'changeSelect';

    public function render()
    {
        $users = User::where('name','LIKE','%'.$this->search.'%')
                    ->orWhere('email','LIKE','%'.$this->search.'%')
                    ->paginate(8);
        return view('livewire.admin-user-list',compact('users'));
    }

    public function changeSelect($value,user $user) {

        $user->update([
            'userType' => $value
        ]);
        if($user->empleado == null) {
           empleado::create([
            'user_id' => $user->id
           ]);
        }



        $this->render();

    }



    public function limpiar_page() {
        $this->resetPage();
    }
}

