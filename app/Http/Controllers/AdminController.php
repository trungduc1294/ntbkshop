<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\BannerImg;
use App\Models\Catagory;
use App\Models\HotProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\QrCode;
use App\Models\User;
use App\Notifications\SendEmailNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function view_catagory()
    {
        if (Auth::user()->usertype == 1) {
            $data = Catagory::all();
            return view('admin.catagory', compact('data'));
        } else {
            return redirect(url('/login'));
        }

    }

    public function add_catagory(Request $request)
    {
        if (Auth::user()->usertype == 1) {
            $data = new Catagory();
            $data->catagory_name = $request->catagory;
            $data->created_at = now()->setTimezone('Asia/Ho_Chi_Minh');
            $data->updated_at = now()->setTimezone('Asia/Ho_Chi_Minh');
            $data->save();
            return redirect()->back()->with('message', 'Catagory Added Successfully');
        } else {
            return redirect(url('/login'));
        }

    }

    public function delete_catagory($id)
    {
        if (Auth::user()->usertype == 1) {
            $data = Catagory::find($id);
            $data->delete();
            return redirect()->back()->with('message', 'Catagory Deleted Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function view_product()
    {
        if (Auth::user()->usertype == 1) {
            $catagory = Catagory::all();
            return view('admin.product', compact('catagory'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function add_product(Request $request)
    {
        if (Auth::user()->usertype == 1) {
            $product = new Product();
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->quantity = $request->quantity;
            $product->catagory = $request->catagory;
            $image = $request->image;
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;

            $product->created_at = now()->setTimezone('Asia/Ho_Chi_Minh');
            $product->updated_at = now()->setTimezone('Asia/Ho_Chi_Minh');

            $product->save();
            return redirect()->back()->with('message', 'Product Added Successfully');
        } else {
            return redirect(url('/login'));
        }

    }

    public function show_product()
    {
        if (Auth::user()->usertype == 1) {
            $products = Product::all();
            return view('admin.show_product', compact('products'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function delete_product($id)
    {
        if (Auth::user()->usertype == 1) {
            $product = Product::find($id);
            $product->delete();
            return redirect()->back()->with('message', 'Product Deleted Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function update_product($id)
    {
        if (Auth::user()->usertype == 1) {
            $product = Product::find($id);
            $catagory = Catagory::all();
            return view('admin.update_product', compact('product', 'catagory'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function update_product_confirm(Request $request, $id)
    {
        if (Auth::user()->usertype == 1) {
            $product = Product::find($id);

            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->quantity = $request->quantity;
            $product->catagory = $request->catagory;
            $image = $request->image;
            if ($image) {
                $imagename = time().'.'.$image->getClientOriginalExtension();
                $request->image->move('product', $imagename);
                $product->image = $imagename;
            }

            $product->updated_at = now()->setTimezone('Asia/Ho_Chi_Minh');


            $product->save();
            return redirect(url('/show_product'))->with('message', 'Product Updated Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function order()
    {
        if (Auth::user()->usertype == 1) {
            $orders = Order::all();
            $shippers = User::where('usertype', 2)->get();
            return view('admin.order', compact('orders', 'shippers'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function today_order()
    {
        if (Auth::user()->usertype == 1) {
            $orders = Order::where('created_at', '>=', date('Y-m-d').' 00:00:00')->where('created_at', '<=', date('Y-m-d').' 23:59:59')->get();
            $shippers = User::where('usertype', 2)->get();
            return view('admin.order', compact('orders', 'shippers'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function delivered($id)
    {
        if (Auth::user()->usertype == 1) {
            $order = Order::find($id);
            $order->delivery_status = 'delivering';
            $order->payment_status = 'paid';
            $order->updated_at = now()->setTimezone('Asia/Ho_Chi_Minh');
            $order->save();
            return redirect()->back()->with('message', 'Order Delivered Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function print_pdf($id)
    {
        if (Auth::user()->usertype == 1) {
            $order = Order::find($id);
            $pdf = PDF::loadView('admin.pdf', compact('order'));
            return $pdf->download('order_details.pdf');
        } else {
            return redirect(url('/login'));
        }
    }

    public function send_email($id)
    {
        if (Auth::user()->usertype == 1) {
            $order = Order::find($id);
            return view('admin.email_info', compact('order'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function send_user_email(Request $request, $id)
    {
        if (Auth::user()->usertype == 1) {
            $order = Order::find($id);
            $details = [
                'greeting' => $request->greeting,
                'firstline' => $request->firstline,
                'body' => $request->body,
                'button' => $request->button,
                'url' => $request->url,
                'lastline' => $request->lastline,
            ];

            Notification::send($order, new SendEmailNotification($details));
            return redirect()->back()->with('message', 'Email Sent Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function search_data(Request $request)
    {
        if (Auth::user()->usertype == 1) {
            $searchText = $request->search;
            $orders = Order::where('name', 'like', '%'.$searchText.'%')
                ->orWhere('phone', 'like', '%'.$searchText.'%')
                ->orWhere('product_title', 'like', '%'.$searchText.'%')
                ->orWhere('created_at', 'like', '%'.$searchText.'%')
                ->orWhere('delivery_status', 'like', '%'.$searchText.'%')
                ->orWhere('shipper_name', 'like', '%'.$searchText.'%')
                ->get();
            return view('admin.order', compact('orders'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function add_banner()
    {
        if (Auth::user()->usertype == 1) {
            $banners = Banner::all();
            $bannerImgs = BannerImg::all();
            return view('admin.add_banner', compact('banners', 'bannerImgs'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function qr_code()
    {
        if (Auth::user()->usertype == 1) {
            $qrCodes = QrCode::all();
            return view('admin.qr_code', compact('qrCodes'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function add_banner_sale(Request $request)
    {
        if (Auth::user()->usertype == 1) {
            $banner = new Banner();
            $banner->title = $request->title;
            $banner->content = $request->bannerContent;
            $banner->save();
            return redirect()->back()->with('message', 'Banner Added Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function add_banner_img(Request $request)
    {
        if (Auth::user()->usertype == 1) {
            $bannerImg = new BannerImg();
            $image = $request->image;
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('images', $imagename);
            $bannerImg->image = $imagename;

            $bannerImg->save();
            return redirect()->back()->with('message', 'Banner Image Added Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function add_qrcode_img(Request $request)
    {
        if (Auth::user()->usertype == 1) {
            $qrcodeImg = new QrCode();
            $image = $request->qr_code;
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->qr_code->move('images', $imagename);
            $qrcodeImg->qr_code = $imagename;
            $qrcodeImg->name = $request->name;

            $qrcodeImg->save();
            return redirect()->back()->with('message', 'QR code Image Added Successfully');
        } else {
            return redirect(url('/login'));
        }
    }


    public function delete_banner($id)
    {
        if (Auth::user()->usertype == 1) {
            $data = Banner::find($id);
            $data->delete();
            return redirect()->back()->with('message', 'Banner Deleted Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function delete_banner_img($id)
    {
        if (Auth::user()->usertype == 1) {
            $data = BannerImg::find($id);
            $data->delete();
            return redirect()->back()->with('message', 'Banner Image Deleted Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function delete_qrcode_img($id)
    {
        if (Auth::user()->usertype == 1) {
            $data = QrCode::find($id);
            $data->delete();
            return redirect()->back()->with('message', 'QR Code Deleted Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function new_product_config()
    {
        if (Auth::user()->usertype == 1) {
            $products = Product::all();
            $hotProducts = HotProduct::all();
            return view('admin.new_product_config', compact('products', 'hotProducts'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function new_product_config_submit(Request $request)
    {
        if (Auth::user()->usertype == 1) {
            $productId = $request->product_id;
            $product = Product::find($productId);

            $hotProduct = new HotProduct();
            $hotProduct->title = $product->title;
            $hotProduct->description = $product->description;
            $hotProduct->price = $product->price;
            $hotProduct->discount_price = $product->discount_price;
            $hotProduct->quantity = $product->quantity;
            $hotProduct->catagory = $product->catagory;
            $hotProduct->image = $product->image;

            $hotProduct->save();
            return redirect()->back()->with('message', 'Hot Product Added Successfully');
        } else {
            return redirect(url('/login'));
        }
    }

    public function delete_hot_product($id)
    {
        if (Auth::user()->usertype == 1) {
            $countHotProducts = HotProduct::all()->count();
            if ($countHotProducts == 1) {
                return redirect()->back()->with('message',
                    'You Can Not Delete This Product. At Least One Product Should Be In Hot Product List.');
            } else {
                $data = HotProduct::find($id);
                $data->delete();
                return redirect()->back()->with('message', 'Hot Product Deleted Successfully');
            }
        } else {
            return redirect(url('/login'));
        }
    }

    public function choose_banner_img($id)
    {
        $bannerImgs = BannerImg::all();
        foreach ($bannerImgs as $banner){
            $banner->status = 'inactive';
            $banner->save();
        }

        $bannerImg = BannerImg::find($id);
        $bannerImg->status = 'active';
        $bannerImg->save();

        return redirect()->back()->with('message', 'Banner Image Selected Successfully');
    }

    public function choose_qrcode_img($id)
    {
        $qrCodes = QrCode::all();
        foreach ($qrCodes as $qrCode){
            $qrCode->status = 'inactive';
            $qrCode->save();
        }

        $qr = QrCode::find($id);
        $qr->status = 'active';
        $qr->save();

        return redirect()->back()->with('message', 'QR code Selected Successfully');
    }

    public function choose_hot_product($id)
    {
        $hotProducts = HotProduct::all();
        foreach ($hotProducts as $product){
            $product->status = 'inactive';
            $product->save();
        }

        $hotProduct = HotProduct::find($id);
        $hotProduct->status = 'active';
        $hotProduct->save();

        return redirect()->back()->with('message', 'Product Selected Successfully');
    }

    public function add_shipper()
    {
        if (Auth::user()->usertype == 1) {
            $users = User::where('usertype', 0)->get();
            $shippers = User::where('usertype', 2)->get();
            return view('admin.add_shipper', compact('users', 'shippers'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function choose_shipper($id)
    {
        $user = User::find($id);
        $user->usertype = 2;
        $user->save();

        return redirect()->back()->with('message', 'Shipper Choosed Successfully');
    }

    public function search_user(Request $request)
    {
        if (Auth::user()->usertype == 1) {
            $searchText = $request->search;
            $users = User::where('name', 'like', '%'.$searchText.'%')
                ->orWhere('email', 'like', '%'.$searchText.'%')
                ->orWhere('phone', 'like', '%'.$searchText.'%')
                ->get();
            return view('admin.add_shipper', compact('users'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function set_shipper(Request $request)
    {
        if (Auth::user()->usertype == 1) {
            $shipperID = $request->shipper_id;
            $orderID = $request->order_id;
            $order = Order::find($orderID);
            $order->shipper_id = $shipperID;

            $shipperName = User::find($shipperID)->name;
            $order->shipper_name = $shipperName;

            $order->save();

            return redirect()->back()->with('message', 'Shipper Set Successfully');
        } else {
            return redirect(url('/login'));
        }
    }


    public function add_admin()
    {
        if (Auth::user()->usertype == 1) {
            $users = User::where('usertype', 0)->get();
            $admins = User::where('usertype', 1)->get();
            return view('admin.add_admin', compact('users', 'admins'));
        } else {
            return redirect(url('/login'));
        }
    }

    public function choose_admin($id)
    {
        $user = User::find($id);
        $user->usertype = 1;
        $user->save();

        return redirect()->back()->with('message', 'admin Choosed Successfully');
    }
}
