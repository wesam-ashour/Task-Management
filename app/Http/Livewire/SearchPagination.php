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

        return view('livewire.search-pagination', [
            'employees' => Client::where('company->en', 'like', $searchTerm)
                ->orWhere('vat->en', 'like', $searchTerm)
                ->orWhere('address->en', 'like', $searchTerm)
                ->orWhere('company->ar', 'like', $searchTerm)
                ->orWhere('vat->ar', 'like', $searchTerm)
                ->orWhere('address->ar', 'like', $searchTerm)
                ->paginate(10)
        ], compact('user'));
    }
}
