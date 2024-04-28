<?php

namespace App\View\Composers;

use Illuminate\View\View;

class MiniCart
{
    public function compose(View $view)
    {
        $cart = \Cart::session(1);

        $items =  $cart->getContent();

        $view->with([
            'cart' => $cart,
            'items' => $items,
        ]);
    }
}