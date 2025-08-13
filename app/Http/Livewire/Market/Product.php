<?php

namespace App\Http\Livewire\Market;

use DB;
use Livewire\Component;
use Livewire\Attributes\Url;

use App\Models\{Cart, Product as Model, Order};

class Product extends Component
{
    #[Url]
    public $slug;
    public $item, $selectedColor = 0, $cartCount = 0;

    #[Session(key: 'current_session')]
    public string $currentSession;

    public $searchQuery = '', $currentThumb = 0;

    public function mount()
    {
        if (session()->missing('current_session')) {
            return redirect()->back();
        }

        $this->currentSession = session('current_session');

        try {
            $this->item = Model::whereSlug($this->slug)->firstOrFail();
        } catch(\Exception $e) {
            \Log::error(['No item found', $this->slug, $e->getMessage()]);
            return redirect()->back();
        }

        if ($cart = Order::whereSession($this->currentSession)->first()) {
            $this->cartCount = $cart->items->sum('unit');
        }
    }

    public function performSearch()
    {
        return redirect()->route('catalogue', ['search' => $this->searchQuery]);
    }

    public function addToCart()
    {
        try {
            $order = Order::updateOrCreate(['session' => $this->currentSession],[
                'status' => 'unpaid',
            ]);
        } catch(\Exception $e) {
            \Log::error(['No item found', $this->slug, $e->getMessage()]);
            return redirect()->back();
        }

        Cart::updateOrCreate([
            'order_id' => $order->id,
            'product_id' => $this->item->id,
            'color_index' => $this->selectedColor
        ],[
            'color' => $this->item->colors[$this->selectedColor],
            'unit' => DB::raw('unit + 1'),
            'price' => DB::raw('price + '.($this->item->promo_price ?? $this->item->price)),
        ]);

        $this->cartCount++;
    }

    public function selectThumb($idx)
    {
        $this->currentThumb = $idx;
    }

    public function selectColor(string $colorIndex)
    {
        $this->selectedColor = $colorIndex;
    }

    public function render()
    {
        return view('livewire.market.page.product');
    }
}
