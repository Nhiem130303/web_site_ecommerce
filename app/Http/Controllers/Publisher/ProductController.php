<?php

namespace App\Http\Controllers\Publisher;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product;
use App\Models\Admin\ProductAttributeValue;
use App\Models\Admin\ProductVariant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('sku')) {
           $query = $query->where('sku', $request->input('sku'));
        }

        $products = $query->orderBy('id','desc')->paginate(5);

        return view('publisher.products.index', ['products' => $products]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($id)
    {
        $product = Product::find($id);

        $productAttributeValues = ProductAttributeValue::leftJoin('attribute_values', 'product_attribute_values.attribute_value_id', '=', 'attribute_values.id')
            ->leftJoin('attributes', 'attribute_values.attribute_id', '=', 'attributes.id')
            ->where("product_attribute_values.product_id", $id)
            ->select([
                'product_attribute_values.product_variant_id as product_variant_id',
                'attributes.id as attribute_id',
                'attributes.name as attribute_name',
                'attributes.code as attribute_code',
                'attribute_values.id as attribute_values_id',
                'attribute_values.value as attribute_values_value',
            ])
            ->get();

        $productVariants = [];

        foreach ($productAttributeValues as $productAttributeValue) {
            $productVariants[$productAttributeValue->product_variant_id][$productAttributeValue->attribute_id] = [
                'attr_name' => $productAttributeValue->attribute_name,
                'attr_value' => $productAttributeValue->attribute_values_value,
                'attr_code' => $productAttributeValue->attribute_code,
            ];
        }

        //pd($productVariants);

        return view('publisher.products.detail', [
            'product' => $product,
            'productVariants' => $productVariants
        ]);
    }
}
