<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class SalesController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('sales.index', [
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $lastTrxId = "TRX-0000";
            $lastOrder = TransactionHeader::latest()->first();
            if ($lastOrder) {
                $lastTrxId = "{$lastOrder->code}-{$lastOrder->number}";
            }

            $newTrxId = $this->generateCodeTrx($lastTrxId);
            list($code, $number) = explode('-', $newTrxId);

            $carts = Cart::with('product')->whereUserId(Auth::user()->id)->get();

            $trxHeader = TransactionHeader::create([
                'code' => $code,
                'number' => $number,
                'user' => Auth::user()->name,
                'total' => $this->calculateGrandTotal($carts),
                'date' => date('Y-m-d'),
            ]);
            $this->saveOrderDetail($trxHeader, $carts);
            $this->clearCart(Auth::user()->id);

            DB::commit();
            return redirect('/sales/success?order_id=' . $newTrxId);
        } catch (Exception $e) {
            DB::rollBack();
            throw new InternalErrorException($e->getMessage());
        }
    }

    public function orderFinish(Request $request)
    {
        $orderId = "xxxx";
        if ($request->has('order_id')) {
            $orderId = $request->order_id;
        }

        return view('sales.finish', [
            'orderId' => $orderId
        ]);
    }

    private function clearCart(int $userId): void
    {
        Cart::whereUserId($userId)->delete();
    }

    private function saveOrderDetail(TransactionHeader $trxHeader, $carts): void
    {
        foreach ($carts as $cart) {
            $product = $cart->product;
            TransactionDetail::create([
                'transaction_header_id' => $trxHeader->id,
                'code' => $trxHeader->code,
                'number' => $trxHeader->number,
                'product_code' => $product->code,
                'price' => $product->price_discount,
                'quantity' => $cart->quantity,
                'unit' => $product->unit,
                'subtotal' => $cart->sub_total,
                'currency' => $product->currency,
            ]);
        }
    }

    private function calculateGrandTotal($carts)
    {
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->sub_total;
        }

        return $total;
    }

    private function generateCodeTrx(string $lastTrxId)
    {
        $numeric_part = substr($lastTrxId, 4);
        $new_numeric_part = str_pad((int)$numeric_part + 1, 4, "0", STR_PAD_LEFT);
        $new_trx_id = "TRX-" . $new_numeric_part;

        return $new_trx_id;
    }
}
