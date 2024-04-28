<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    private $userId = 1; // Not login

    public function index()
    {
        $items = \Cart::session($this->userId)->getContent();

        $address = \Cart::session('address')->getContent();

        return view('web.cart', [
            'items' => $items,
            'address' => $address
        ]);
    }

    public function addToCart(Request $request)
    {
        if ($request->ajax()) {

            $data = $request->all();

            $productVariant = ProductVariant::with('product')->find($data['id']);

            \Cart::session($this->userId)->add([
                'id' => $productVariant->id,
                'name' => $productVariant->name,
                'price' => $productVariant->plv_3,
                'quantity' => $data['qty'],
                'attributes' => [
                    'image' => $productVariant->product->img_is_default,
                    'product_id' => $productVariant->product->id
                ]
            ]);

            return response()->json([
                'message' => 'Items added successfully'
            ]);
        }
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {

            $data = $request->all();

            $arr = $data['arr'];

            foreach ($arr as $key => $value) {
                \Cart::session($this->userId)->update($key, [
                    'quantity' => [
                        'relative' => false,
                        'value' => $value
                    ]
                ]);
                if (\Cart::session($this->userId)->get($key)->quantity == 0) {
                    \Cart::session($this->userId)->remove($key);
                }
            }

            return response()->json([
                'message' => 'Items updated successfully'
            ]);
        }
    }

    public function removeItem(Request $request)
    {
        if ($request->ajax()) {

            $data = $request->all();

            \Cart::session($this->userId)->remove($data['id']);

            return response()->json([
                'message' => 'Items removed successfully'
            ]);
        }
    }

    public function updateAddress(Request $request)
    {
        if ($request->ajax()) {

            $data = $request->all();

            $arr = $data['arr'];

            \Cart::session('address')->add([
                'id' => 'address',
                'name' => 'address',
                'price' => 1,
                'quantity' => 1,
                'attributes' => [
                    'city' => $arr['city'],
                    'district' => $arr['district'],
                    'ward' => $arr['ward'],
                    'street' => $arr['street']
                ]
            ]);

            return response()->json([
                'message' => 'Address update successfully'
            ]);
        }
    }
}
