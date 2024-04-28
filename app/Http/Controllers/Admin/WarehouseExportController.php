<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreateWarehouseExportRequest;
use App\Http\Requests\Admin\UpdateWarehouseExportRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Product;
use App\Models\Admin\ProductInventory;
use App\Repositories\Admin\WarehouseExportRepository;
use App\Repositories\Admin\LocationRepository;
use App\Repositories\Admin\ProductVariantRepository;
use App\Services\UpdateProductQuantityService;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Auth;

class WarehouseExportController extends AppBaseController
{
    /** @var WarehouseExportRepository $warehouseExportRepository */
    private $warehouseExportRepository;

    private $locationRepository;

    private $productVariantRepository;

    private $updateProductQuantityService;

    public function __construct(
        WarehouseExportRepository $warehouseExportRepo,
        LocationRepository $locationRepository,
        ProductVariantRepository $productVariantRepository,
        UpdateProductQuantityService $updateProductQuantityService
    )
    {
        $this->warehouseExportRepository = $warehouseExportRepo;
        $this->locationRepository = $locationRepository;
        $this->productVariantRepository = $productVariantRepository;
        $this->updateProductQuantityService = $updateProductQuantityService;
    }

    /**
     * Display a listing of the WarehouseExport.
     */
    public function index(Request $request)
    {
        $warehouseExports = $this->warehouseExportRepository->paginate(10);

        return view('admin.warehouse_exports.index')
            ->with('warehouseExports', $warehouseExports);
    }

    /**
     * Show the form for creating a new WarehouseExport.
     */
    public function create()
    {
        $locations = $this->locationRepository->all();

        return view('admin.warehouse_exports.create')->with('locations', $locations);
    }

    /**
     * @param CreateWarehouseExportRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function store(CreateWarehouseExportRequest $request)
    {
        $input = $request->all();

        $productVariant = $this->productVariantRepository->find($input["product_variant_id"]);

        if (empty($productVariant)) {
            Flash::error('Product is not exist!');

            return redirect(route('admin.warehouseExports.create'));
        }

        $input['product_id'] = $productVariant->product_id;

        $input['created_by_id'] = Auth::id();

        $response = $this->updateProductQuantityService->subtractionQuantity(
            $input["location_id"],
            $input["product_variant_id"],
            $input["quantity"]
        );

        if (!$response["status"]) {
            Flash::error($response["message"]);

            return redirect(route('admin.warehouseExports.create'));
        }

        $this->warehouseExportRepository->create($input);

        $this->updateInventoryStatus(0, $productVariant->product_id);

        Flash::success('Warehouse Export saved successfully.');

        return redirect(route('admin.warehouseExports.index'));
    }

    /**
     * @param $qty
     * @param $productId
     */
    private function updateInventoryStatus($qty, $productId)
    {
        $inventory = ProductInventory::where('product_id', $productId)
            ->pluck('quantity')
            ->sum();

        if ($inventory == $qty) {
            $product = Product::where('id', $productId)->first();

            $product->inventory_status = Product::INVENTORY_STATUS_OUT_STOCK;
            $product->save();
        }
    }

    /**
     * Display the specified WarehouseExport.
     */
    public function show($id)
    {
        $warehouseExport = $this->warehouseExportRepository->find($id);

        if (empty($warehouseExport)) {
            Flash::error('Warehouse Export not found');

            return redirect(route('admin.warehouseExports.index'));
        }

        return view('admin.warehouse_exports.show')->with('warehouseExport', $warehouseExport);
    }

    /**
     * Show the form for editing the specified WarehouseExport.
     */
    public function edit($id)
    {
        $warehouseExport = $this->warehouseExportRepository->find($id);

        if (empty($warehouseExport)) {
            Flash::error('Warehouse Export not found');

            return redirect(route('admin.warehouseExports.index'));
        }

        return view('admin.warehouse_exports.edit')->with('warehouseExport', $warehouseExport);
    }

    /**
     * Update the specified WarehouseExport in storage.
     */
    public function update($id, UpdateWarehouseExportRequest $request)
    {
        $warehouseExport = $this->warehouseExportRepository->find($id);

        if (empty($warehouseExport)) {
            Flash::error('Warehouse Export not found');

            return redirect(route('admin.warehouseExports.index'));
        }

        $warehouseExport = $this->warehouseExportRepository->update($request->all(), $id);

        Flash::success('Warehouse Export updated successfully.');

        return redirect(route('admin.warehouseExports.index'));
    }

    /**
     * Remove the specified WarehouseExport from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $warehouseExport = $this->warehouseExportRepository->find($id);

        if (empty($warehouseExport)) {
            Flash::error('Warehouse Export not found');

            return redirect(route('admin.warehouseExports.index'));
        }

        $this->warehouseExportRepository->delete($id);

        Flash::success('Warehouse Export deleted successfully.');

        return redirect(route('admin.warehouseExports.index'));
    }
}
