<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Models\Admin\AttributeValue;
use App\Models\Admin\Product;
use Illuminate\Http\Request;

class AjaxController extends AppBaseController
{
    /**
     * @param Request $request
     * @return string
     */
    public function getAttributeValue(Request $request)
    {
        if (!isset($request->attribute_id))
            return '';

        $attributeValues = AttributeValue::where("attribute_id", $request->attribute_id)->get();
        $str = '<option value="0">No select</option>';
        foreach ($attributeValues as $value) {
            $str .= '<option value="' . $value->id . '">' . $value->value . '</option>';
        }

        return $str;
    }

    public function getProductsHomePage(Request $request)
    {
        $pageSize = 20;

        if ($request->has("page")) {
            $page = $request->get("page");
        }

        $query = Product::query();

        if ($request->has("categoryId") && $request->get('categoryId') != 0) {
            $query = $query->where("category_id", $request->get("categoryId"));
        }

        $products = $query->select([
            "products.id as productId",
            "products.name as productName",
            "products.slug",
            "products.plv3 as price_v_3",
            "products.img_is_default as file_id",
            "categories.id as categoryId",
            "categories.name as categoryName",
            "categories.slug as categorySlug",
        ])
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->where('products.status', 1)
            ->orderBy('products.id', 'ASC')
            ->paginate($pageSize, ['*'], 'page', $page ?? 0);


        return $this->sendSuccess([
            'products' => $products
        ]);
    }

}
