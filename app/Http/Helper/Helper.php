<?php
use App\Models\AddonItems;
use App\Models\AddonProduct;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;

function getAdminDetail()
{
    return User::where('role', 'admin')->first();
}
function active_if_match($path)
{
    return Request::is($path . '*') ? 'active' : '';
}

function active_if_full_match($path)
{
    return Request::is($path) ? 'active' : '';
}
function formateDate($formate, $date)
{
    return date($formate, strtotime($date));
}

function getTimeDifference($created_at)
{
    // Convert the created_at string to a DateTime object
    $createdDate = new DateTime($created_at);
    $currentDate = new DateTime(); // Current date and time

    // Calculate the difference
    $interval = $createdDate->diff($currentDate);

    // Get the difference in days, hours, and minutes
    $days = $interval->days;
    $hours = $interval->h;
    $minutes = $interval->i;

    if ($days == 0 && $hours == 0) {
        return "{$minutes} minutes ago";
    } elseif ($days == 0) {
        return "{$hours} hours and {$minutes} minutes ago";
    } else {
        return "{$days} days, {$hours} hours, and {$minutes} minutes ago";
    }
}
function getAllCity()
{
    return City::where('status', 'Active')->get();
}
function getMenuCity()
{
    return City::where('is_menu', true)->where('status', 'Active')->limit(8)->get();
}
function getPopularCity()
{
    return City::where('is_popular', true)->where('status', 'Active')->get();
}
function getMenuCategory()
{
    return Category::where('is_menu', true)->get();
}
function getTrendingCategory()
{
    return Category::where('is_trending', true)->get();
}
function discountPrice($price, $discount)
{
    if($discount == null || $discount == 0){
        return $price;
    }else{
        return ceil($price - $price * $discount / 100);
    }
}

function getSlug($str)
{
    return strtolower(str_replace(" ", "-", $str));
}

function uploadFile($request, $file, $path)
{
    if ($request->hasFile($file)) {
        $filename = $request->file($file);
        $newname = uniqid() . md5(microtime()) . '.' . $filename->getClientOriginalExtension();
        $filename->move(public_path($path), $newname);
        return $newname;
    }
    return null;
}
function uploadMultipleFile($request, $files, $path)
{
    $filePaths = [];
    foreach ($files as $file) {
        $newname = uniqid() . md5(microtime()) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($path), $newname);
        $filePaths[] = $newname;
    }
    return $filePaths;
}

function getAddonData($id = null){
    // return $product_id != null ? AddonItems::where('user_id', auth()->user()->id)->where('product_id', $product_id)->get() : [];
        // dd($id);
    if($id != null){
        return AddonProduct::find((int) $id);
    }else{
        return [];
    }

}

function getAddonItem($id){
    return AddonProduct::find($id);
}

function getProductDetail($id = null){
    return $id != null ? Product::find($id) : [];
}

function cartCount(){
    $data = json_decode(Cookie::get('cart', '[]'), true);
    return count($data);
}

// function checkAddionItem($array, $id){
//     return in_array($id, $array);
// }