<?php

namespace App\View\Components\Layouts\Market;

use Illuminate\View\Component;

class Base extends Component
{
    protected $template = 'market.base';

    protected function getData() {
        return [];
    }

    protected function getMeta()
    {
        $slug = $this->slug ?? 'default';
        return [
            'metaTitle' => __('pages.' . $slug) !== 'pages.' . $slug ? __('pages.' . $slug) : 'YesSheSaidIDo',
            'metaDescription' => __('meta.' . $slug) !== 'meta.' . $slug ? __('meta.' . $slug) : __('meta.default_description'),
            'metaKeywords' => __('meta.' . $slug . '_keywords') !== 'meta.' . $slug . '_keywords' ? __('meta.' . $slug . '_keywords') : __('meta.default_keywords'),
        ];
    }

    public function render()
    {
        return view('layouts.' . $this->template, array_merge($this->getData(), $this->getMeta()));
    }
}
