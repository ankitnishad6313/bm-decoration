<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\AddonItems;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Review;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Cookie;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
    public function changePassowrd()
    {
        return view('change-password');
    }
    public function cart()
    {
        $data = Cart::where('user_id', Auth::user()->id)->get();
        // dd($data);
        return view('cart', compact('data'));
    }

    public function addItem(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     "product_id" => 'required|exists:products,id',
        //     "city_id" => 'required|exists:cities,id',
        //     "date" => 'required|date|after_or_equal:today',
        //     // "time" => [
        //     //     'required',
        //     //     function ($attribute, $value, $fail) {
        //     //         $currentTime = now(); // Get current time
        //     //         $selectedTime = Carbon::createFromFormat('H:i', $value); // Parse selected time
        
        //     //         // Add 5 hours to current time for validation
        //     //         $minValidTime = $currentTime->copy()->addHours(5)->format('H:i');

        //     //         // Compare selected time with minValidTime (check if selected time is less than 5 hours from now)
        //     //         if ($selectedTime->lt($currentTime->copy()->addHours(5))) {
        //     //             $fail('The ' . $attribute . ' must be at least 5 hours from the current time. Please select a later time.');
        //     //         }
        //     //     }
        //     // ]
        // ]);      

        // if($validator->fails()){
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        $data = [
            'user_id' => auth()->user()->id,
            'product_id' => $request->product_id,
            'city_id' => $request->city_id,
            'date' => $request->date,
            'time' => $request->time,
        ];
        $item = Cart::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'product_id' => $request->product_id
            ],
            $data
        );
        
        if ($item) {
            $responseCode = 201;
            $response = [
                'message' => 'Item Added to Cart.',
                'status' => true,
            ];
        }

        return response()->json($response, $responseCode);
    }

    public function cartCount(){
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        if($cart->count() > 0){
            $responseCode = 200;
            $response = [
                'message' => $cart->count() ." Item found in cart.",
                'status' => true,
                'count' => $cart->count(),
                'data' => $cart,
            ];
        }else{
            $responseCode = 400;
            $response = [
                'message' => 'Your cart is empty',
                'status' => false,
            ];
        }

        return response()->json($response, $responseCode);
    }

    public function addonAdd(Request $request){
        $user_id = auth()->user()->id;
        $product_id = $request->pro_id;
        $addon_pro_ids = explode(",", $request->addon_pro_ids);
        $addon_pro_quantity = explode(",", $request->addon_pro_quantity);
        foreach ($addon_pro_ids as $key => $value) {
            $data = [
                'user_id' => $user_id,
                'product_id' => $product_id,
                'addon_product_id' => $value,
                'quantity' => $addon_pro_quantity[$key]
            ];

            AddonItems::create($data);
        }

            $responseCode = 201;
            $response = [
                'message' => "Addon Items added.",
                'status' => true,
            ];
        return response()->json([$response, $responseCode]);
    }



    public function productquantity(Request $request){
        $cart_id = $request->id;
        $quantity = $request->quantity;

        $cart = Cart::find($cart_id)->update(['quantity' => $quantity]);

        if($cart){
            $responseCode = 200;
            $response = [
                'message' => "Cart Updated.",
                'status' => true,
            ];
        }else{
            $responseCode = 401;
            $response = [
                'message' => "Cart not Updated.",
                'status' => false,
            ];
        }
        return response()->json($response, $responseCode);
    }

    public function addonquantity(Request $request){
        $addon_id = $request->id;
        $quantity = $request->quantity;

        $addonitems = AddonItems::find($addon_id)->update(['quantity' => $quantity]);

        if($addonitems){
            $responseCode = 200;
            $response = [
                'message' => "Addon Updated.",
                'status' => true,
            ];
        }else{
            $responseCode = 401;
            $response = [
                'message' => "Addon not Updated.",
                'status' => false,
            ];
        }
        return response()->json($response, $responseCode);
    }

    public function deleteCart($id){
        Cart::find($id)->delete();
        return redirect()->route('cart');
    }
    public function deleteAddon(Request $request) {
        $cart = json_decode(Cookie::get('cart', '[]'), true); // Retrieve cart
    
        if (isset($cart[$request->product_id])) {
    
            if (isset($request->index)) {
                // Correctly removing the specific index
                array_splice($cart[$request->product_id]['addon_ids'], $request->index, 1);
                array_splice($cart[$request->product_id]['addon_quantitys'], $request->index, 1);
            }
    
            // Update the cart in the cookie
            Cookie::queue('cart', json_encode($cart), 60 * 24 * 30);
    
            return back()->with('success', 'Item Removed!');
        }
    
        return back()->with('error', 'Item not found in cart.');
    }
    

    public function orders(Request $request){
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(15);
        return view('orders', compact('orders'));
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone' => 'required|numeric|digits:10|unique:users,phone,' . auth()->user()->id,
            'alternate_phone' => 'required|numeric|digits:10|unique:users,alternate_phone,' . auth()->user()->id,
            'gender' => 'required|in:Male,Female',
            'profile_pic' => 'sometimes|image|mimes:png,jpeg,jpg,webp',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|digits:6',
            'country' => 'required|string',
            'current_address' => 'required',
            'permanent_address' => 'required',
        ]);

        
        $res = User::find(Auth::user()->id)->update($request->all());

        if ($request->hasFile('profile_pic')) {
            $profile_pic = uploadFile($request, 'profile_pic', 'uploads/profile');
            User::find(Auth::user()->id)->update(['profile_pic' => $profile_pic]);
        }

        if($res){
            return back()->with('success','Profile Updated Successfully');
        }else{
            return back()->with('error','Profile not Updated');
        }

    }

    public function review(Request $request){
        $request->validate(['id' => 'required|exists:products,id']);
        $product_id = $request->id;
        return view('add-review', compact('product_id'));
    }
    public function reviewStore(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'star' => 'required|numeric|min:1|max:5',
            'comment' => 'required'
        ]);
        
        $review = $request->all();
        $review['user_id'] = auth()->user()->id;
        
        if(Review::create($review)){
            return redirect()->route('user-orders')->with('success', 'Review Created');
        }else{
            return redirect()->route('user-orders')->with('error', 'Review not Created');
        }
    }
}
