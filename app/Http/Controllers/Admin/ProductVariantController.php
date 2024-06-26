<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateProductVariantRequest;
use App\Http\Requests\Admin\UpdateProductVariantRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Product;
use App\Models\Admin\ProductAttributeValue;
use App\Models\Admin\ProductVariant;
use App\Models\Admin\Attribute;
use App\Models\Admin\AttributeValue;
use App\Repositories\Admin\ProductRepository;
use App\Repositories\Admin\ProductVariantRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends AppBaseController
{
    /** @var ProductVariantRepository $productVariantRepository */
    private $productVariantRepository;


    private $productRepository;

    public function __construct(
        ProductVariantRepository $productVariantRepo,
        ProductRepository $productRepository
    )
    {
        $this->productVariantRepository = $productVariantRepo;
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the ProductVariant.
     */
    public function index(Request $request)
    {
        $productVariants = $this->productVariantRepository->paginate(10);

        return view('admin.product_variants.index')
            ->with('productVariants', $productVariants);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $attributes = Attribute::all();

        $product = Product::with([
            'productAttributeValue' => function ($query) {
                $query->where('product_variant_id', '>', 0);
            },
            'productAttributeValue.attributeValue'
        ])
            ->where("id", $request->get("product_id"))
            ->first();

        $variantAttribute = $attributeValue = [];

        if (!empty($product->productAttributeValue)) {
            foreach ($product->productAttributeValue as $value) {
                $variantAttribute[] = $value->attributeValue->attribute_id;
            }
        }

        if (!empty($variantAttribute)) {
            $attributeValue = AttributeValue::whereIn("attribute_id", $variantAttribute)->get();
        }

        return view('admin.product_variants.create')
            ->with('attributes', $attributes)
            ->with("variantAttribute", $variantAttribute)
            ->with("variantAttributeValue", $attributeValue)
            ->with('product', $product);
    }

    /**
     * @param CreateProductVariantRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateProductVariantRequest $request)
    {
        $input = $request->all();

        $result = $this->variantAttributeValidate(
            $input["product_id"],
            $input["attribute_id_1"],
            $input["attribute_value_id_1"],
            $input["attribute_id_2"] ?? 0,
            $input["attribute_value_id_2"] ?? 0
        );

        if (!$result["status"]) {
            Flash::error($result["message"]);

            return redirect()->back();
        }

        try {
            DB::beginTransaction();

            $variant = $this->productVariantRepository->create($input);

            $this->createProductVariantAttribute(
                $input["product_id"],
                $variant->id,
                [$input["attribute_value_id_1"], $input["attribute_value_id_2"] ?? 0]
            );

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            Flash::error($exception->getMessage() . " Line:" . $exception->getLine());
        }

        Flash::success('Product Variant saved successfully.');

        return redirect(route('admin.productVariants.index'));
    }

    /**
     * Display the specified ProductVariant.
     */
    public function show($id)
    {
        $productVariant = $this->productVariantRepository->find($id);

        if (empty($productVariant)) {
            Flash::error('Product Variant not found');

            return redirect(route('admin.productVariants.index'));
        }

        return view('admin.product_variants.show')->with('productVariant', $productVariant);
    }

    /**
     * Show the form for editing the specified ProductVariant.
     */
    public function edit($id)
    {
        $productVariant = ProductVariant::with([
            "productAttributeValue",
            "productAttributeValue.attributeValue",
            "productAttributeValue.attributeValue.attribute"
        ])->find($id);

        if (empty($productVariant)) {
            Flash::error('Product Variant not found');

            return redirect(route('admin.productVariants.index'));
        }

        $product = Product::find($productVariant->product_id);

        return view('admin.product_variants.edit')
            ->with('product', $product)
            ->with('productVariant', $productVariant);
    }

    /**
     * Update the specified ProductVariant in storage.
     */
    public function update($id, UpdateProductVariantRequest $request)
    {
        $productVariant = $this->productVariantRepository->find($id);

        if (empty($productVariant)) {
            Flash::error('Product Variant not found');

            return redirect(route('admin.productVariants.index'));
        }

        $productVariant = $this->productVariantRepository->update($request->all(), $id);

        Flash::success('Product Variant updated successfully.');

        return redirect(route('admin.productVariants.index'));
    }

    /**
     * Remove the specified ProductVariant from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productVariant = $this->productVariantRepository->find($id);

        if (empty($productVariant)) {
            Flash::error('Product Variant not found');

            return redirect(route('admin.productVariants.index'));
        }

        $this->productVariantRepository->delete($id);

        Flash::success('Product Variant deleted successfully.');

        return redirect(route('admin.productVariants.index'));
    }

    /**
     * @param $product_id
     * @param $variant_id
     * @param $aryAttributeValue
     * @return bool
     */
    public function createProductVariantAttribute($product_id, $variant_id, $aryAttributeValue = [])
    {
        foreach ($aryAttributeValue as $attribute_value) {
            if ($attribute_value == 0) continue;

            $productAttribute = new ProductAttributeValue();
            $productAttribute->product_id = $product_id;
            $productAttribute->product_variant_id = $variant_id;
            $productAttribute->attribute_value_id = $attribute_value;
            $productAttribute->save();
        }

        return true;
    }

    /**
     * @param $product_id
     * @param int $attr1
     * @param int $attrValue1
     * @param int $attr2
     * @param int $attrValue2
     * @return array
     */
    public function variantAttributeValidate($product_id, $attr1, $attrValue1, $attr2 = 0, $attrValue2 = 0)
    {
        if ($attr1 == $attr2)
            return ["status" => false, "message" => "Duplicate Attribute"];

        if ($attrValue1 == $attrValue2)
            return ["status" => false, "message" => "Duplicate Attribute Value"];

        $product = Product::with(['productAttributeValue' => function ($query) {
            $query->where('product_variant_id', '>', 0);
        }, "productAttributeValue.attributeValue"])->where("id", $product_id)->first();

        if ($product->productAttributeValue->count() == 0)
            return ["status" => true, "messages" => ""];

        $aryAttrId = $attributeValueKey = [];

        foreach ($product->productAttributeValue as $attributeValue) {
            if (count($aryAttrId) < 3)
                $aryAttrId[$attributeValue->attributeValue->attribute_id] = $attributeValue->attributeValue->attribute_id;

            if (isset($attributeValueKey[$attributeValue->product_variant_id])) {
                $attributeValueKey[$attributeValue->product_variant_id] .= "_" . $attributeValue->attribute_value_id;
                continue;
            }

            $attributeValueKey[$attributeValue->product_variant_id] = $attributeValue->attribute_value_id;
        }

        $valueKey = '';

        if ($attrValue1 != 0)
            $valueKey = $attrValue1;

        if ($attr2 != 0)
            $valueKey = $valueKey . "_" . $attrValue2;

        if (in_array($valueKey, $attributeValueKey))
            return ["status" => false, "message" => "Attribute available !"];

        if ($attr1 != 0) {
            if (!in_array($attr1, $aryAttrId))
                return ["status" => false, "message" => "Attribute 1 ID not in array !"];
        }

        if ($attr2 != 0) {
            if (!in_array($attr2, $aryAttrId))
                return ["status" => false, "message" => "Attribute 2 ID not in array !"];
        }

        $attrValues = AttributeValue::whereIn("id", [$attrValue1, $attrValue2])->get();
        foreach ($attrValues as $val) {
            if (!in_array($val->attribute_id, $aryAttrId))
                return ["status" => false, "message" => "Attribute value 1 ID not in array !"];
        }

        return ["status" => true, "messages" => ""];
    }
}
