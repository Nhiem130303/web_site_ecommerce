<?php

namespace App\Services;

use App\Repositories\Admin\ProductInventoryRepository;

class UpdateProductQuantityService
{
    protected $productInventoryRepository;

    public function __construct(ProductInventoryRepository $productInventoryRepository)
    {
        $this->productInventoryRepository = $productInventoryRepository;
    }

    /**
     * Tăng số lượng
     *
     * @param $locationId
     * @param $productId
     * @param $productVariantId
     * @param $quantity
     * @return array
     * @throws \Exception
     */
    public function addQuantity($locationId, $productId, $productVariantId, $quantity)
    {
        $inventory = $this->productInventoryRepository->allQuery([
            "product_variant_id" => $productVariantId,
            "location_id" => $locationId
        ])->first();

        if (empty($inventory)) {
            $inventory = $this->productInventoryRepository->makeModel();
            $inventory->product_id = $productId;
            $inventory->product_variant_id = $productVariantId;
            $inventory->location_id = $locationId;
            $inventory->quantity = $quantity;
            $inventory->save();
        } else {
            $inventory->quantity = $inventory->quantity + $quantity;
            $inventory->save();
        }

        return [
            'status' => true,
            "message" => 'success',
            "data" => [
                "inventory" => $inventory
            ]
        ];
    }

    /**
     * Giảm số lượng
     *
     * @param $locationId
     * @param $productVariantId
     * @param $quantity
     * @return array
     * @throws \Exception
     */
    public function subtractionQuantity($locationId, $productVariantId, $quantity)
    {
        $inventory = $this->productInventoryRepository->allQuery([
            "product_variant_id" => $productVariantId,
            "location_id" => $locationId
        ])->first();

        if (empty($inventory)) {
            return [
                'status' => false,
                "message" => 'Product Id is not exist!',
                "data" => []
            ];
        }

        $inventory->quantity = ($inventory->quantity > $quantity) ? $inventory->quantity - $quantity : 0;
        $inventory->save();

        return [
            'status' => true,
            "message" => 'success',
            "data" => [
                "inventory" => $inventory
            ]
        ];
    }
}