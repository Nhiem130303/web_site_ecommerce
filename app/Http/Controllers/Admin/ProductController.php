<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateProductRequest;
use App\Http\Requests\Admin\UpdateProductRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Category;
use App\Models\Admin\Product;
use App\Models\Admin\ProductImage;
use App\Repositories\Admin\ProductInventoryRepository;
use App\Repositories\Admin\ProductRepository;
use App\Repositories\Admin\ProductVariantRepository;
use App\Services\File\UploadService;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ProductController extends AppBaseController
{
    /** @var ProductRepository $productRepository */
    private $productRepository;

    /** @var ProductVariantRepository $productVariantRepository */
    private $productVariantRepository;

    private $productInventoryRepository;

    private $uploadService;

    public function __construct(
        ProductRepository $productRepo,
        ProductVariantRepository $productVariantRepository,
        ProductInventoryRepository $productInventoryRepository,
        UploadService $uploadService
    )
    {
        $this->productRepository = $productRepo;
        $this->productVariantRepository = $productVariantRepository;
        $this->productInventoryRepository = $productInventoryRepository;
        $this->uploadService = $uploadService;
    }

    /**
     * Display a listing of the Product.
     */
    public function index()
    {
        $products = $this->productRepository->paginate(10);

        return view('admin.products.index')
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new Product.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();

        return view('admin.products.create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created Product in storage.
     *
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateProductRequest $request)
    {
        $input = $request->all();

        $input['sku'] = 'QT-';

        $input['plv2'] = $input['plv1'] + 50000;

        $input['plv3'] = $input['plv1'] + 50000;

        $input['inventory_status'] = Product::INVENTORY_STATUS_OUT_STOCK;

        $product = $this->productRepository->create($input);

        $product->sku = $input['sku'] . $product->id;

        $product->save();

        if ($request->file('file')) {
            $response = $this->uploadService->uploadImages($product->id, $request);

            if (!$response["status"]) {
                pd($response["message"]);
            }

            foreach ($response["data"]["file_ids"] as $value) {
                $arrProductImages[] = [
                    'product_id' => $product->id,
                    'file_id' => $value,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
            }

            if (isset($arrProductImages)) {
                ProductImage::insert($arrProductImages);

                $product->img_is_default = $arrProductImages[0]['file_id'];
                $product->save();
            }
        }

        Flash::success('Product saved successfully.');

        return redirect(route('admin.products.index'));
    }

    /**
     * Display the specified Product.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        return view('admin.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified Product.
     */
    public function edit($id)
    {
        $categories = Category::where('status', 1)->get();

        $product = $this->productRepository->find($id);

        $productVariants = $this->productVariantRepository->allQuery(["product_id" => $id])->paginate();

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        return view('admin.products.edit')
            ->with('product', $product)
            ->with('categories', $categories)
            ->with('productVariants', $productVariants);
    }

    /**
     * @param $id
     * @param UpdateProductRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateProductRequest $request)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        $this->productRepository->update($request->all(), $id);

        if ($request->file('file')) {
            $response = $this->uploadService->uploadImages($id, $request);

            if (!$response["status"]) {
                pd($response["message"]);
            }

            foreach ($response["data"]["file_ids"] as $value) {
                $arrProductImages[] = [
                    'product_id' => $id,
                    'file_id' => $value,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
            }

            if (isset($arrProductImages)) {
                ProductImage::insert($arrProductImages);
            }
        }

        Flash::success('Product updated successfully.');

        return redirect(route('admin.products.index'));
    }

    /**
     * Remove the specified Product from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if (empty($product)) {
            Flash::error('Product not found');

            return redirect(route('admin.products.index'));
        }

        $this->productRepository->delete($id);

        Flash::success('Product deleted successfully.');

        return redirect(route('admin.products.index'));
    }

    public function setDefault($productId, Request $request)
    {
        $product = Product::where('id', $productId)
            ->first();
        $product->is_default = $request->img_default;
        $product->save();

        return back()->with('success', 'Bạn đã chọn ảnh mặc định thành công');

    }
}
