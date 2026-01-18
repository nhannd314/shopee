<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'total'));
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
                "quantity" => $quantity,
                "price" => $product->price,
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
        if(isset($cart[$request->id])) {
            if($request->quantity > 0) {
                $cart[$request->id]["quantity"] = $request->quantity;
            } else {
                unset($cart[$request->id]);
            }
            session()->put('cart', $cart);
        }

        $total = 0;
        foreach($cart as $item) { $total += $item['price'] * $item['quantity']; }

        $subtotal = isset($cart[$request->id]) ? $cart[$request->id]['price'] * $cart[$request->id]['quantity'] : 0;

        return response()->json([
            'total' => number_format($total),
            'subtotal' => number_format($subtotal),
            'count' => collect($cart)->sum('quantity')
        ]);
    }

    public function checkout()
    {
        //
    }
}
