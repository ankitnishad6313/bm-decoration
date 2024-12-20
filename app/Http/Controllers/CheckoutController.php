<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\AddonProduct;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Auth;
use Cookie;
use Illuminate\Http\Request;
use Mail;
use Razorpay\Api\Api;
class CheckoutController extends Controller
{
  public $api;
  public $name;
  public $currency;

  public $logo;

  public function __construct()
  {
    $this->api = new Api("rzp_test_g0Nt7GG8ZJzsqq", "SfgIzJOVfnk86aumtcc79c0T"); // Test
    // $this->api = new Api("rzp_live_i1MgTiCn9sC95E", "XEZYj6tvDhydEaYoZIqsTso6"); // Live
    $this->name = "B.M. Decoration";
    $this->currency = "INR";
    $this->logo = public_path('assets/images/logo.png');
  }

  public function checkout(Request $request)
  {
    $totalAmount = 0;
    $order_ids = [];
    $currency = $this->currency ?? 'INR';  // Default to INR if currency not set

    $finaldata = [];
    // Cookie Data
    $carts = json_decode(Cookie::get('cart', '[]'), true); // Retrieve cart from cookie   

    foreach ($request->cart_id as $id) {
      $cart = $carts[$id];
      if (!$cart)
        continue;  // Skip if cart not found

      $addonsub_total = 0;
      $addon_product_id = [];
      $addon_product_quantity = [];
      $addon_product_price = [];
      foreach ($cart['addon_ids'] as $qua => $add_id) {
        $item = AddonProduct::find($add_id);
        $addon_product_id[] = $add_id;
        $addon_product_quantity[] = $cart['addon_quantitys'][$qua];
        $addon_product_price[] = $item->price;
        $addonsub_total += $item->price * $cart['addon_quantitys'][$qua];
      }

      $product = Product::find($cart['product_id']);

      $product_price = $product->discount_price * $cart['quantity'];
      $totalAmount += $product_price + $addonsub_total;

      $cartItems = [
        'user_id' => auth()->user()->id,
        'product_id' => $cart['product_id'],
        'city_id' => $cart['city_id'],
        'date' => $cart['date'],
        'time' => $cart['time'],
        'product_quantity' => $cart['quantity'],
        'product_price' => $product->discount_price,
        'addon_id' => $addon_product_id,
        'addon_quantity' => $addon_product_quantity,
        'addon_price' => $addon_product_price,
        'total_amount' => $product_price + $addonsub_total,
      ];

      $finaldata[] = $cartItems;
    }

    session()->put('total_amount', $totalAmount);
    session()->put('cartid', $request->cart_id);
    session()->put('order_product_data', $finaldata);

    return view('checkout', compact('finaldata'));
  }

  public function payment(Request $request)
  {
    // dd($request->all());

    $user = Auth::user();

  //   $request->validate([
  //     'name' => 'required|string',
  //     'email' => 'required|email|unique:users,email,' . auth()->user()->id,
  //     'phone' => 'required|numeric|digits:10|unique:users,phone,' . auth()->user()->id,
  //     'alternate_phone' => 'required|numeric|digits:10|unique:users,alternate_phone,' . auth()->user()->id,
  //     'city' => 'required|string',
  //     'state' => 'required|string',
  //     'pincode' => 'required|digits:6',
  //     'country' => 'required|string',
  //     'current_address' => 'required',
  // ]);

    $user_data = [
      'payment_status' => 'success',
      'name' => $request->name,
      'email' => $request->email,
      'phone' => $request->phone,
      'alternate_phone' => $request->alternate_phone,
      'current_address' => $request->current_address,
      'landmark' => $request->landmark,
      'pincode' => $request->pincode,
      'city' => $request->city,
      'occasion' => $request->occasion,
      'location' => $request->location,
    ];

    $user->update($user_data);

    session()->put('user_order_data', $user_data);

    $totalAmount = session('total_amount');

    $order_id = (string) rand(111111111111, 999999999999);  // Random order ID

    // Create Razorpay Order with line items
    $orderData = [
      'receipt' => $order_id,
      'amount' => $totalAmount * 100,  // Amount in paise
      'currency' => $this->currency,
      'payment_capture' => 1,  // Auto capture payment
      'line_items' => [
        [
          'name' => "Demo Product",
          'description' => "Demo Product Description",
          // 'amount' => $request->amount * 100,  // Amount in paise
          // 'currency' => $this->currency,
          'quantity' => 1,  // Quantity of the item
        ]
      ],
    ];

    // $order = $this->api->order->create($orderData);  // Create Razorpay order

    // dd($order);
    // Redirect the user to Razorpay payment page
    $paymentLink = $this->api->invoice->create([
      'type' => 'link',
      'amount' => $totalAmount * 100,  // Amount in paise
      'currency' => $this->currency,
      'description' => 'Product Purchase',
      'customer' => [
        'name' => 'Ankit Kumar',  // Change to user data if needed
        'email' => 'rajpartyplanner@gmail.com',  // Change to user email
        'contact' => 9914925565,  // Change to user contact number
      ],
      'notes' => [
        'product_name' => "Demo Product",
        'order_id' => $order_id,
      ],
      'line_items' => [
        [
          'name' => "Demo Product",
          'description' => "Demo Product Description",
          // 'amount' => $request->amount * 100,  // Amount in paise
          // 'currency' => $this->currency,
          'quantity' => 1,
        ]
      ],
      'callback_url' => route('payment.response'),  // URL for handling response
      'callback_method' => 'get',
    ]);

    return redirect($paymentLink['short_url']);  // Redirect to payment page
  }

  // Step 3: Handle Razorpay response
  public function response(Request $request)
  {
    $paymentId = $request->input('razorpay_payment_id');
    $orderId = $request->input('razorpay_order_id');
    $signature = $request->input('razorpay_signature');

    if ($request->razorpay_invoice_status == "paid") {
      $order_ids = [];
      foreach (session('order_product_data') as $value) {
        $res = Order::create(array_merge($value, session('user_order_data')));
        $order_ids[] = $res->id;
      }

      session()->forget('order_product_data');

      foreach (session('cartid') as $cart_id) {
        // Cart::find($cart_id)->delete();
        $cart = json_decode(Cookie::get('cart', '[]'), true); // Retrieve cart

        if (isset($cart[$cart_id])) {
          unset($cart[$cart_id]); // Remove product by ID
          Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // Update cookie
        }
      }
      $data = Order::whereIn('id', $order_ids)->get();
      Mail::to('bmdecorations5565@gmail.com')->send(new OrderMail($data));

      return redirect()->route('user-orders')->with('success', 'Payment was Successful');
    } else {
      return redirect('/')->with('error', 'Payment was Failed');
    }
  }

  public function success()
  {
    return 'Payment was successful and product information has been saved!';
  }

  public function failure()
  {
    return 'Payment failed. Please try again.';
  }
}