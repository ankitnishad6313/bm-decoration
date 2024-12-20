<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, City, Contact, Order, Product, Review, User};
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function dashboard(){
        // ini_set('memory_limit', '1024M'); 
        $data['user'] = User::where('role', 'user')->count();
        $data['today_user'] = User::where('role', 'user')->whereDate('created_at', today())->count();
        $data['contact'] = Contact::count();
        $data['today_contact'] = Contact::orderBy('id', 'desc')->whereDate('created_at', today())->count();
        $data['category'] = Category::count();
        $data['active_category'] = Category::where('status', 'Active')->count();
        $data['product'] = Product::count();
        $data['active_product'] = Product::where('status', 'Active')->count();
        $data['order'] = Order::where('payment_status', 'success')->count();
        $data['today_order'] = Order::where('payment_status', 'success')->whereDate('created_at', today())->count();
        $data['city'] = City::count();
        $data['review'] = Review::count();
        $data['recent_orders'] = Order::where('payment_status', 'success')->whereDate('created_at', '>=', now()->subDays(15))->paginate(15);
        $data['recent_contacts'] = Contact::orderBy('id', 'desc')->limit(3)->get();
        return view('admin.dashboard', compact('data'));
    }

    public function profile(){
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }
    public function contacts(){
        $contacts = Contact::orderBy('id', 'desc')->paginate(15);
        return view('admin.contacts', compact('contacts'));
    }
    public function contactDelete($id){
        Contact::find($id)->delete();
        return back()->with('success', 'Contact has been Deleted Successfully!');
    }

    public function orders(){
        $data = Order::where('payment_status', 'success')->orderBy('id', 'desc')->paginate(15);
        return view('admin.orders', compact('data'));
    }

    public function orderDelete($id){
        Order::find($id)->delete();
        return back()->with('success', 'Order has been Deleted Successfully!');
    }

    public function users(){
        $data = User::where('role', 'user')->orderBy('id', 'desc')->paginate(15);
        return view('admin.users-list', compact('data'));
    }

    public function userDelete($id){
        User::find($id)->delete();
        return back()->with('success', 'User has been Deleted Successfully!');
    }
}
