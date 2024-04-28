<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\ProductInventoryRepository;
use Illuminate\Http\Request;
use Flash;

class ProductInventoryController extends AppBaseController
{
    /** @var ProductInventoryRepository $productInventoryRepository*/
    private $productInventoryRepository;

    public function __construct(ProductInventoryRepository $productInventoryRepo)
    {
        $this->productInventoryRepository = $productInventoryRepo;
    }

    /**
     * Display a listing of the ProductInventory.
     */
    public function index(Request $request)
    {
        $query = $this->productInventoryRepository->allQuery();

        $productInventories = $query->with(['productVariant', 'product', 'location'])->paginate();

        return view('admin.product_inventories.index')
            ->with('productInventories', $productInventories);
    }
}
