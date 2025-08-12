<?php

namespace App\Http\Livewire\Market;

use Livewire\Component;

use App\Models\Order;

class Cart extends Component
{
    public string $currentSession;
    public $order = null;

    public function mount($session)
    {
        $this->currentSession = $session;

        try {
            $this->order = Order::with(['items', 'items.product'])->whereSession($this->currentSession)->first();
        } catch(\Exception $e) {
            \Log::error(['Order not found', $e->getMessage()]);
            return redirect()->back();
        }
    }

    public function doCheckout()
    {
        return redirect()->route('checkout', $this->currentSession);
    }

    public function render()
    {
        return view('livewire.market.page.cart');
    }
}
