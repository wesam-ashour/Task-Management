<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;

class SearchPagination extends Component
{
    use WithPagination;
    public $searchTerm;
    public function render()
    {
        $searchTerm = '%' . $this->searchTerm . '%';
        $user = Auth::user();

        return view('livewire.search-pagination',[
            'employees' => Client::where('company','like', $searchTerm)->orWhere('vat', 'like', $searchTerm)->orWhere('address', 'like', $searchTerm)->paginate(10)
        ],compact('user'));
    }
}
