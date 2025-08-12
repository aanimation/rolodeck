<?php

namespace App\Http\Livewire\Market;

use Livewire\Component;
use Livewire\Attributes\Session;
use Carbon\Carbon;
use Illuminate\Support\Str;

use App\Models\{Product, Order};

class Catalogue extends Component
{
    #[Session(key: 'current_session')]
    public string $currentSession;
    public $searchQuery = '', $cartCount = 0;

    public function mount()
    {
        if (empty($this->currentSession)) {
            $this->currentSession = $this->generateSessionId();
            session()->put('current_session', $this->currentSession);
        } else {
            if ($cart = Order::whereSession($this->currentSession)->first()) {
                $this->cartCount = $cart->items->sum('unit');
            }
        }

        if (request()->has('search')) {
            $this->searchQuery = request()->query('search');
        }
    }

    protected function generateSessionId(): string
    {
        if (session()->has('current_session')) {
            $existingSession = session('current_session');

            if ($this->isValidSessionId($existingSession)) {
                return $existingSession;
            }
        }

        return Carbon::now()->format('dmYHis') . Str::random(6);
    }

    protected function isValidSessionId(string $sessionId): bool
    {
        return preg_match('/^\d{14}_[a-zA-Z0-9]{6}$/', $sessionId);
    }

    public function performSearch()
    {
        // Do nothing
    }

    public function updatedSearchQuery($value)
    {
        if ($value === '') {
            return redirect()->route('catalogue');
        }
    }

    protected function getData()
    {
        $items = Product::whereIsActive(true)
        ->when($this->searchQuery, function($query) {
            $query->where('name', 'LIKE', '%'.$this->searchQuery.'%');
        })
        ->get();

        return [
            'title' => 'Breville',
            'items' => $items
        ];
    }

    public function render()
    {
        return view('livewire.market.page.catalogue', $this->getData());
    }
}
