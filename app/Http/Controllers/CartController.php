<?php

namespace App\Http\Controllers;

use App\Helpers\CartHelper;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class CartController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['label' => 'Giỏ hàng']
        ];
        $cart = session()->get('cart', []);
        $total = CartHelper::getTotal($cart);

        return view('cart', compact('breadcrumb', 'cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;

        // Lấy giỏ hàng hiện tại từ session
        $cart = session()->get('cart', []);

        // Nếu sản phẩm đã có, tăng số lượng. Nếu chưa có, thêm mới.
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "slug" => $product->slug,
                "quantity" => $quantity,
                "price" => $product->real_price,
                "image" => $product->featured_image // Sử dụng Accessor đã tạo
            ];
        }

        session()->put('cart', $cart);
        // Tính lại tổng số lượng để trả về cho Frontend
        $totalQuantity = collect($cart)->sum('quantity');

        return response()->json([
            'status' => 'success',
            'message' => 'Đã thêm sản phẩm vào giỏ hàng!',
            'cart_count' => $totalQuantity
        ]);
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart');

        if (isset($cart[$request->id])) {
            if ($request->quantity > 0) {
                $cart[$request->id]["quantity"] = $request->quantity;
            }
            else {
                unset($cart[$request->id]);
            }
            session()->put('cart', $cart);
        }

        $total = CartHelper::getTotal($cart);

        $subtotal = isset($cart[$request->id]) ? $cart[$request->id]['price'] * $cart[$request->id]['quantity'] : 0;

        return response()->json([
            'total' => number_format($total),
            'subtotal' => number_format($subtotal),
            'count' => collect($cart)->sum('quantity')
        ]);
    }

    public function checkout(Request $request)
    {
        // 1. Validate thông tin từ form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone'     => 'required|numeric|digits_between:10,11',
            'shipping_address'   => 'required|string',
            'note'      => 'nullable|string'
        ], [
            'customer_name.required' => 'Vui lòng nhập họ tên.',
            'phone.required'     => 'Vui lòng nhập số điện thoại.',
            'shipping_address.required'   => 'Vui lòng cung cấp địa chỉ giao hàng.',
        ]);

        // 2. Lấy giỏ hàng từ Database qua Cart Token trong Cookie
        //$token = Cookie::get('cart_token');
        //$cartItems = CartItem::where('cart_token', $token)->get();
        $cart = session()->get('cart');

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        try {
            DB::beginTransaction();

            // 4. Lưu vào bảng Orders
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'phone'         => $request->phone,
                'shipping_address'       => $request->shipping_address,
                'note'          => $request->note,
                'total_amount'  => CartHelper::getTotal($cart),
                'status'        => 'pending',
            ]);

            // 5. Lưu vào bảng OrderItems (Chi tiết từng món)
            foreach ($cart as $id=>$item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $id,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['price'],
                ]);
            }

            session()->forget('cart');

            DB::commit();

            $adminEmail = 'nhannd314@gmail.com';
            Notification::route('mail', $adminEmail)->notify(new \App\Notifications\NewOrderNotification($order));

            // Chuyển hướng đến trang cảm ơn hoặc thông báo thành công
            return redirect()->route('cart.success')->with('order_id', $order->id);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi xử lý đơn hàng. Vui lòng thử lại.');
        }
    }

    public function success(Request $request)
    {
        $orderId = $request->order_id;
        return view('cart-success');
    }
}
