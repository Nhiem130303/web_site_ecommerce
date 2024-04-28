<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateWarehouseReceiptRequest;
use App\Http\Requests\Admin\UpdateWarehouseReceiptRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Product;
use App\Repositories\Admin\LocationRepository;
use App\Repositories\Admin\ProductVariantRepository;
use App\Repositories\Admin\WarehouseReceiptRepository;
use App\Services\UpdateProductQuantityService;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;

class WarehouseReceiptController extends AppBaseController
{
    /** @var WarehouseReceiptRepository $warehouseReceiptRepository */
    private $warehouseReceiptRepository;

    private $locationRepository;

    private $productVariantRepository;

    private $updateProductQuantityService;

    public function __construct(
        WarehouseReceiptRepository $warehouseReceiptRepo,
        LocationRepository $locationRepository,
        ProductVariantRepository $productVariantRepository,
        UpdateProductQuantityService $updateProductQuantityService
    )
    {
        $this->warehouseReceiptRepository = $warehouseReceiptRepo;
        $this->locationRepository = $locationRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->updateProductQuantityService = $updateProductQuantityService;
    }

    /**
     * Display a listing of the WarehouseReceipt.
     */
    public function index(Request $request)
    {
        $warehouseReceipts = $this->warehouseReceiptRepository->allQuery()->with([
            'product',
            'productVariant',
            'user',
            'location'
        ])->paginate(10);

        return view('admin.warehouse_receipts.index')
            ->with('warehouseReceipts', $warehouseReceipts);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
        $locations = $this->locationRepository->all();

        return view('admin.warehouse_receipts.create')
            ->with('locations', $locations);
    }

    /**
     * @param CreateWarehouseReceiptRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(CreateWarehouseReceiptRequest $request)
    {
        $input = $request->all();

        $productVariant = $this->productVariantRepository->find($input["product_variant_id"]);

        $input['product_id'] = $productVariant->product_id;

        $input['created_by_id'] = Auth::user()->id;

        $response = $this->updateProductQuantityService->addQuantity(
            $input["location_id"],
            $input["product_id"],
            $input["product_variant_id"],
            $input["quantity"]
        );

        if (!$response["status"]) {
            Flash::error($response["message"]);

            return redirect()->back();
        }

        $this->warehouseReceiptRepository->create($input);

        $this->updateInventoryStatus(Product::INVENTORY_STATUS_OUT_STOCK, $productVariant->product_id);

        Flash::success('Warehouse Receipt saved successfully.');

        return redirect(route('admin.warehouseReceipts.index'));
    }

    /**
     * @param $status
     * @param $productId
     */
    private function updateInventoryStatus($status, $productId){
        $product = Product::where('id', $productId)->first();

        if ($product->inventory_status == $status){
            $product->inventory_status = Product::INVENTORY_STATUS_IN_STOCK;
            $product->save();
        }
    }

    /**
     * Display the specified WarehouseReceipt.
     */
    public function show($id)
    {
        $warehouseReceipt = $this->warehouseReceiptRepository->find($id);

        if (empty($warehouseReceipt)) {
            Flash::error('Warehouse Receipt not found');

            return redirect(route('admin.warehouseReceipts.index'));
        }

        return view('admin.warehouse_receipts.show')->with('warehouseReceipt', $warehouseReceipt);
    }

    /**
     * Show the form for editing the specified WarehouseReceipt.
     */
    public function edit($id)
    {
        $warehouseReceipt = $this->warehouseReceiptRepository->find($id);

        if (empty($warehouseReceipt)) {
            Flash::error('Warehouse Receipt not found');

            return redirect(route('admin.warehouseReceipts.index'));
        }

        return view('admin.warehouse_receipts.edit')->with('warehouseReceipt', $warehouseReceipt);
    }

    /**
     * Update the specified WarehouseReceipt in storage.
     */
    public function update($id, UpdateWarehouseReceiptRequest $request)
    {
        $warehouseReceipt = $this->warehouseReceiptRepository->find($id);

        if (empty($warehouseReceipt)) {
            Flash::error('Warehouse Receipt not found');

            return redirect(route('admin.warehouseReceipts.index'));
        }

        $warehouseReceipt = $this->warehouseReceiptRepository->update($request->all(), $id);

        Flash::success('Warehouse Receipt updated successfully.');

        return redirect(route('admin.warehouseReceipts.index'));
    }

    /**
     * Remove the specified WarehouseReceipt from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $warehouseReceipt = $this->warehouseReceiptRepository->find($id);

        if (empty($warehouseReceipt)) {
            Flash::error('Warehouse Receipt not found');

            return redirect(route('admin.warehouseReceipts.index'));
        }

        $this->warehouseReceiptRepository->delete($id);

        Flash::success('Warehouse Receipt deleted successfully.');

        return redirect(route('admin.warehouseReceipts.index'));
    }
}
