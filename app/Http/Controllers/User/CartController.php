<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AddonProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = json_decode(Cookie::get('cart', '[]'), true); // Get cart from cookie
        $addon = AddonProduct::orderBy('is_popular', 'desc')->get();
        // dd($data);
        return view('cart', compact('data', 'addon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true); // Retrieve cart from cookie

        $product = [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity ?? 1,
            'city_id' => $request->city_id,
            'date' => $request->date,
            'time' => $request->time,
        ];

        // Handle addon_ids
        if (isset($request->addon_ids) && !empty($request->addon_ids)) {
            $product['addon_ids'] = array_filter(explode(",", $request->addon_ids));
        } else {
            $product['addon_ids'] = []; // Set to empty array if no addon_ids are provided
        }

        // Handle addon_quantitys
        if (isset($request->addon_quantitys) && !empty($request->addon_quantitys)) {
            $product['addon_quantitys'] = array_filter(explode(",", $request->addon_quantitys));
        } else {
            $product['addon_quantitys'] = []; // Set to empty array if no addon_quantitys are provided
        }

        $cart[$product['product_id']] = $product; // Add or update product by ID

        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // Save cookie for 7 days

        return response()->json([
            'message' => 'Product added to cart!',
            'status' => true,
            'cart' => $cart,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
{
    $cart = json_decode(Cookie::get('cart', '[]'), true); // Retrieve cart

    if (isset($cart[$request->id])) {
        $product = [
            'product_id' => $request->id,
            'quantity' => $request->quantity ?? $cart[$request->id]['quantity'],
            'city_id' => $request->city_id ?? $cart[$request->id]['city_id'],
            'date' => $request->date ?? $cart[$request->id]['date'],
            'time' => $request->time ?? $cart[$request->id]['time'],
        ];

        // Handle addon_ids
        if (isset($request->addon_ids) && !empty($request->addon_ids)) {
            $product['addon_ids'] = array_filter(explode(",", $request->addon_ids));
        } else {
            $product['addon_ids'] = []; // Set to empty array if no addon_ids are provided
        }

        // Handle addon_quantitys
        if (isset($request->addon_quantitys) && !empty($request->addon_quantitys)) {
            $product['addon_quantitys'] = array_filter(explode(",", $request->addon_quantitys));
        } else {
            $product['addon_quantitys'] = []; // Set to empty array if no addon_quantitys are provided
        }

        $cart[$request->id] = $product;
        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // Update cookie

        return response()->json(['message' => 'Cart updated!', 'status' => true], 200);
    }

    return response()->json(['message' => 'Product not found in cart.', 'status' => false], 404);
}




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true); // Retrieve cart

        if (isset($cart[$id])) {
            unset($cart[$id]); // Remove product by ID
            Cookie::queue('cart', json_encode($cart), 60 * 24 * 30); // Update cookie
        }
        return redirect()->back()->with('success', 'Product removed from cart!');
        // return response()->json(['message' => 'Product removed from cart!', 'status' => true], 200);
    }

    public function cartCount()
    {
        $cart = json_decode(Cookie::get('cart', '[]'), true); // Retrieve cart
        $count = count($cart);

        return response()->json([
            'message' => "{$count} item(s) in cart.",
            'status' => true,
            'count' => $count,
        ], 200);
    }



    public function setAddonItems(Request $request)
    {
        // $id = $request->id;
        $id = 4;
        $html = "";

        // Retrieve cart from the cookie
        $cart = json_decode(Cookie::get('cart', '[]'), true);
        $addonids = $cart[$id]['addon_ids'] ?? [];
        $addonquantitys = $cart[$id]['addon_quantitys'] ?? [];

        // Retrieve all addon products
        $addons = AddonProduct::orderBy('is_popular', 'desc')->get();

        foreach ($addons as $item) {
            $isAdded = in_array($item->id, $addonids) ? "add-addon-added" : "";
            $class = $item->is_popular ? "populardiv" : "generaldiv";

            // Check if the addon exists in the cart and fetch its quantity
            $index = array_search($item->id, $addonids);
            $quantity = $index !== false ? $addonquantitys[$index] : 0;

            $html .= '
                <div class="addon-item ' . $class . '">
                    <div class="addon-image">
                        <img src="' . url("/uploads/addon/{$item->image}") . '" 
                             alt="' . htmlspecialchars($item->name) . '" 
                             height="50" width="50">
                    </div>
                    <p class="addon-item-name">' . htmlspecialchars($item->name) . '</p>
                    <p class="addon-item-price">₹' . $item->price . '</p>
                    <div class="addon-item-controller">
                        <div class="addon-item-btns">
                            <button class="addon-item-btn minus">−</button>
                            <span class="addon-counting">' . $quantity . '</span>
                            <button class="addon-item-btn plus">+</button>
                        </div>
                        <button id="' . $item->id . '" 
                                data-custom-value="' . $item->price . '" 
                                data-custom-value2="' . $quantity . '" 
                                data-custom-value3="' . $item->id . '"
                                class="add-addon-btn ' . $isAdded . '">ADD</button>
                    </div>
                </div>';
        }

        // dd($html);

        return response()->json($html, 200);
    }


    public function addonquantity(Request $request)
    {
        $cart_id = $request->id;
        $addon_id = $request->addon_id;
        $quantity = $request->quantity;


        // Retrieve cart from the cookie
        $cart = json_decode(Cookie::get('cart', '[]'), true);

        // Check if the cart entry exists
        if (!isset($cart[$cart_id])) {
            return response()->json(['message' => 'Cart item not found!', 'status' => false], 404);
        }

        $addon_ids = $cart[$cart_id]['addon_ids'] ?? [];
        $addon_quantitys = $cart[$cart_id]['addon_quantitys'] ?? [];

        // Find the index of the addon_id in the addon_ids array
        $index = array_search($addon_id, $addon_ids);

        if ($index !== false) {
            // Update the corresponding quantity in addon_quantitys
            $addon_quantitys[$index] = $quantity;
        } else {
            return response()->json(['message' => 'Addon not found!', 'status' => false], 404);
        }

        // Update the cart item with the new addon_quantitys
        $cart[$cart_id]['addon_quantitys'] = $addon_quantitys;

        // Save the updated cart back to the cookie
        Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);

        return response()->json(['message' => 'Addon quantity updated!', 'status' => true], 200);
    }

}
