<?php

namespace App\Http\Livewire\Market;

use Livewire\Component;

use Stripe\Stripe;
use Stripe\Checkout\Session;

use App\Models\{Customer, Order};

class Checkout extends Component
{
    public $name, $email, $address, $addressNumber, $postalCode;    
    public string $currentSession;
    public $order, $total, $validForm = false;


    public function rules(){
        return [
            'name'          => 'required',
            'email'         => 'required|email',
            'address'       => 'required',
            'addressNumber' => 'nullable',
            'postalCode'    => 'required|integer'
        ];
    }

    public function messages() 
    {
        return [
            '*.required'    => 'This field is required.',
            '*.integer'    => 'Required number.'
        ];
    }

    public function mount($session)
    {
        $this->currentSession = $session;
        $this->order = Order::with(['items'])->whereSession($this->currentSession)->first();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->validForm = filled($this->name)
        && filled($this->email)
        && filled($this->address)
        && filled($this->postalCode);

    }

    public function submit()
    {
        // $this->validate();

        try {
            $customer = Customer::updateOrCreate(['email' => $this->email],[
                'name'              => $this->name,
                'address'           => $this->address,
                'address_number'    => $this->addressNumber,
                'postal_code'       => $this->postalCode,
            ]);
        } catch(\Exception $e) {
            \Log::error(['Customer: something went wrong', $e->getMessage()]);
        }

        $this->order->update([
            'customer_id' => $customer->id,
            'total' => $this->order->items->sum('price'),
        ]);
        
        \Log::info(['Checkout submitted']);

        $this->stripeCheckout([
            'order' => $this->order->session,
            'price' => $this->order->items->sum('price'),
            'quantity' => $this->order->items->sum('unit')
        ]);
    }

    protected function stripeCheckout($input)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $input['order'],
                    ],
                    'unit_amount' => $input['price'] * 100,
                ],
                'quantity' => $input['quantity'],
            ]],
            'mode' => 'payment',
            'success_url' => route('catalogue', ['session_id' => $input['order'], 'success' => true]),
            'cancel_url' => route('catalogue', ['session_id' => $input['order'], 'success' => false]),
        ]);

        \Log::info(['Stripe', $session]);

        session()->forget('current_session');

        return redirect($session->url);
    }

    public function render()
    {
        return view('livewire.market.page.checkout');
    }
}
