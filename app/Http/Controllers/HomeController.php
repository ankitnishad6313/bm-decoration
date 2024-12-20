<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Route;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 'Active')->get();
        $categories = Category::where('status', 'Active')->limit(8)->get();
        $data = Category::where('is_popular', true)->get();
        return view('index', compact('data', 'categories', 'sliders'));
    }

    public function about()
    {
        return view('about-us');
    }
    public function contact()
    {
        return view('contact');
    }
    public function storeContact(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'required|digits:10',
            'message' => 'required'
        ]);

        try {
            Contact::create($request->all());
            $message = "Thanks for contacting with us!!";
            $staus = 'success';
        } catch (\Throwable $th) {
            $message = "Something went wrong. Please try again!!";
            $staus = 'error';
        }

        return back()->with($staus, $message);
    }

    public function balloonDecorations()
    {
        return view('balloon-decorations');
    }
    public function balloonBouquets()
    {
        return view('balloon-bouquets');
    }
    public function termsAndConditions()
    {
        return view('terms-and-conditions');
    }
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }
    public function returnAndRefund()
    {
        return view('return-and-refund');
    }
    public function disclaimer()
    {
        return view('disclaimer');
    }
    public function shippingPolicy()
    {
        return view('shipping-policy');
    }
    public function premiumDecorations()
    {
        return view('premium-decorations');
    }
    public function anniversaryDecorations()
    {
        return view('anniversary-decorations');
    }
    public function babyShowerDecorations()
    {
        return view('baby-shower-decorations');
    }
    public function babyWelcomeDecorations()
    {
        return view('baby-welcome-decorations.baby-welcome-decorations');
    }
    public function babyBoy()
    {
        return view('baby-welcome-decorations.for-baby-boy');
    }
    public function babyGirl()
    {
        return view('baby-welcome-decorations.for-baby-girl');
    }
    public function flowers()
    {
        return view('baby-welcome-decorations.flowers');
    }
    public function kidsThemeDecorations()
    {
        return view('kids-theme-decorations.kids-theme-decorations');
    }

    public function forBoy()
    {
        return view('kids-theme-decorations.for-boys');
    }
    public function forGirl()
    {
        return view('kids-theme-decorations.for-girl');
    }
    public function stageDecorations()
    {
        return view('stage-decorations');
    }
}
