<?php

namespace App\Http\Controllers\Web;

use App\Http\Requests\Admin\CreateOrderRequest;
use App\Http\Requests\Admin\UpdateOrderRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
use App\Repositories\Admin\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class OrderController extends AppBaseController
{
    private $userId = 1; // Not login

    /** @var OrderRepository $orderRepository*/
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new Order.
     */
    public function create()
    {
    }

    /**
     * Store a newly created Order in storage.
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        try {
            DB::beginTransaction();

            $input['user_id'] = $this->userId;
            $input['status'] = 1;

            $order = $this->orderRepository->create($input);

            $this->createOrderItem(
                $order->id,
                $input['order_items']
            );

            \Cart::session($this->userId)->clear();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            Flash::error($exception->getMessage() . " Line:" . $exception->getLine());
        }

        return view('web.order_complete');
    }

    public function createOrderItem($id, $orderItems)
    {
        foreach ($orderItems as $orderItem) {
            $item = new OrderItem();
            $item->order_id = $id;
            $item->product_id = $orderItem['product_id'];
            $item->product_variant_id = $orderItem['product_variant_id'];
            $item->quantity = $orderItem['quantity'];
            $item->price = $orderItem['price'];
            $item->save();
        }
    }

    /**
     * Display the specified Order.
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified Order.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified Order in storage.
     */
    public function update($id, UpdateOrderRequest $request)
    {
    }

    /**
     * Remove the specified Order from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
    }
}
