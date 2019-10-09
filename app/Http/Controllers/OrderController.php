<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateOrder;
use App\Order;
use App\Partner;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use phpDocumentor\Reflection\Types\Mixed_;

class OrderController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return View
     */
    public function index(): View
    {
        $orders = Order::paginate(50);

        return view('orders', compact('orders'));
    }

    /**
     * @param $id
     * @return View
     */
    public function edit($id): View
    {
        /** @var Order $order */
        $order = Order::findOrFail($id);

        /** @var array $data */
        $data = $order->getData();

        /** @var array $status_list */
        $status_list = $order->getStatusList();

        /** @var Collection $partners */
        $partners = Partner::all();

        return view('order', compact('order', 'data', 'status_list', 'partners'));
    }

    /**
     * @param UpdateOrder $request
     * @return View
     */
    public function update(UpdateOrder $request): View
    {

        Order::where('id', \Route::input('id'))->update([
            'client_email' => $request->input('client_email'),
            'status' => $request->input('status'),
            'partner_id' => $request->input('partner'),
        ]);

        return $this->edit(\Route::input('id'))->with('message', 'ok');
    }
}
