<?php

namespace crocodicstudio\crudbooster\controllers;

use CRUDBooster;
use DigiStore24\DigiStoreApi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Cache;
use App\Mail\TwoFactorAuth;
use App\Mail\ForgetPassword;

use Mail;

class AdminController extends CBController
{
    function getIndex()
    {
        setcookie('user_id', session('admin_id'), time() + 60 * 60 * 24 * 100);
        setcookie('user_name', session('admin_name'), time() + 60 * 60 * 24 * 100);

        $data = [];
        if (CRUDBooster::isSuperadmin()) {
            $key = '304282-I9hUcwVlDQmJGwRjKpza6ddxZBlKhqoqdhTEocMZ';
            $digi = DigiStoreApi::connect($key);

            $data['drmusers'] = DB::table('cms_users')->latest()->take(10)->get();

            //$from = date('Y-m-d', strtotime('-7 days'));
            //$to = date('Y-m-d');
            //$topAffiliates = $digi->statsAffiliateToplist($from, $to);
            //$data['top_affiliates'] = $topAffiliates->top_list;

            //$bestDigistoreProducts = $digi->statsSales('week', $from, $to);
            //$data['best_DigistoreProducts'] = $bestDigistoreProducts->amounts;

            //$lastSalesOfDigistore = $digi->listProducts('name', 'asc');

            $lastSalesOfDigistore = $digi->listPurchases('-1M', 'now', [], 'date', 'desc');

            //dd($lastSalesOfDigistore->purchase_list);
            // foreach($lastSalesOfDigistore->purchase_list as $value){
            //     //dd($value->amount);
            //     foreach($value->items as $items){
            //         //dd($items->product_name);
            //     }
            // }

            $data['last_SalesOfDigistore'] = $lastSalesOfDigistore;
            //dd($data['last_SalesOfDigistore']);


            /* Average Uses Of Drm Of Total User */

            /* Getting All Users Id */
            $all_user = DB::table('cms_logs')
                ->join('cms_users', 'cms_users.id', '=', 'cms_logs.id_cms_users')
                ->select('cms_logs.id_cms_users')
                ->whereNotNull('cms_logs.id_cms_users')
                ->where('cms_users.id_cms_privileges', '!=',  1)
                ->where('cms_users.id_cms_privileges', '!=',  2)
                ->where('cms_users.id_cms_privileges', '!=',  7)
                ->distinct('cms_logs.id_cms_users')
                ->orderby('cms_logs.id_cms_users')
                ->pluck('cms_logs.id_cms_users')
                ->toArray();
            //dd($all_user);


            $monthly_uses = array();
            $monthly_uses_all = array();

            /* Initializing Array With Time Formate */
            for ($i = 1; $i <= 12; $i++) {
                $monthly_uses_all[$i] =  sprintf('%02d:%02d', '00', '00');
            }

            /* Getting All Users Total DRM using Time*/
            for ($user = 0; $user < count($all_user); $user++) {

                /* Getting Uses Month Wise */
                for ($month = 1; $month <= 12; $month++) {
                    $userInfo = DB::table('cms_logs')
                        ->select('id_cms_users', 'created_at', 'type')
                        ->whereNotNull('type')
                        ->where('id_cms_users', '=', $all_user[$user])
                        ->where(function ($query) {
                            $query->where('type', '=', 'login');
                            $query->orWhere('type', '=', 'logout');
                        })
                        ->whereMonth('created_at', $month)
                        ->orderby('created_at')
                        ->get()
                        ->toArray();
                    //dd($userInfo);

                    $login_time = array();
                    $logout_time = array();

                    $j = 0;
                    $k = 0;

                    /* Seperating Login and Logout Information */
                    for ($i = 0; $i < count($userInfo); $i++) {
                        if ($userInfo[$i]->type == 'login') {
                            $login_time[$k] = $userInfo[$i]->created_at;
                            $k++;
                        } else if ($userInfo[$i]->type == 'logout') {
                            $logout_time[$j] = $userInfo[$i]->created_at;
                            $j++;
                        }
                    }
                    //dd($login_time, $logout_time);

                    if (count($login_time) > count($logout_time)) {
                        $value = count($login_time);
                    } else {
                        $value = count($logout_time);
                    }
                    //dd($value);

                    $time_diff = array();

                    /* Calculating Loging And Logout Time Difference In HOURS and MINUTES */
                    for ($L = 0; $L < $value; $L++) {
                        if (!empty($login_time[$L]) && !empty($logout_time[$L])) {
                            $start = strtotime($login_time[$L]);
                            $end = strtotime($logout_time[$L]);
                            $diff = abs($start - $end) / (60 * 60);
                            $time_diff[$L] = sprintf('%02d:%02d', (int) $diff, fmod($diff, 1) * 60);
                            // $time_diff[$L] = date('H:i:s', strtotime($logout_time[$L])-strtotime($login_time[$L]));
                        }
                        // else if(!empty($login_time[$L])){
                        //     $start = strtotime($login_time[$L]);
                        //     $end = strtotime('now');
                        //     $diff = abs($start-$end)/(60*60);
                        //     $time_diff[$L] = sprintf('%02d:%02d', (int) $diff, fmod($diff, 1) * 60);
                        //     // $time_diff[$L] = date('H:i:s', strtotime('now')-strtotime($login_time[$L]));
                        // }
                    }
                    //dd($time_diff);

                    $all_seconds = 0;
                    $hour = 0;
                    $minute = 0;

                    /* Adding All the Time of Using DRM for One Month */
                    foreach ($time_diff as $time) {
                        list($hour, $minute) = explode(':', $time);
                        $all_seconds += $hour * 3600;
                        $all_seconds += $minute * 60;
                    }

                    $total_minutes = floor($all_seconds / 60);
                    $hours = floor($total_minutes / 60);
                    $minutes = $total_minutes % 60;

                    //dd(sprintf('%02d:%02d', $hours, $minutes));

                    $monthly_uses[$month] =  sprintf('%02d:%02d', $hours, $minutes);
                    //dd($monthly_uses);
                }
                //dd($monthly_uses, $monthly_uses_all);

                /* Adding Total Use of Time Per User Per Month */
                for ($i = 1; $i <= 12; $i++) {
                    $monthly_hour = 0;
                    $monthly_min = 0;
                    list($monthly_hour, $monthly_min) = explode(':', $monthly_uses[$i]);

                    $monthly_hour_all = 0;
                    $monthly_min_all = 0;
                    list($monthly_hour_all, $monthly_min_all) = explode(':', $monthly_uses_all[$i]);

                    $total_hour = (int) $monthly_hour + (int) $monthly_hour_all;
                    $total_min = (int) $monthly_min + (int) $monthly_min_all;

                    $monthly_uses_all[$i] =  sprintf('%02d:%02d', $total_hour, $total_min);
                    //dd($monthly_uses_all[$i]);
                }
                //dd($monthly_uses_all);
            }
            //dd($monthly_uses_all);

            $average_hours = [];

            /* Average Use of Time(HOURS and MINUTES) in Hours*/
            for ($i = 1; $i <= 12; $i++) {
                $value = $monthly_uses_all[$i];
                $hour = 0;
                $min = 0;
                list($hour, $min) = explode(':', $value);

                $total_seconds = 0;
                $total_seconds = $total_seconds + $hour * 3600;
                $total_seconds = $total_seconds + $min * 60;

                $hour = $total_seconds / (60 * 60);

                $average_hours[$i] = round($hour / count($all_user));
                //dd($average_hours);
            }
            //dd($average_hours);

            $data['average_uses'] = $average_hours;

            /* Average Uses Of Drm Of Total User End*/


            /* Selecting Latest 10 Orders */
            $data['latest_order'] = DB::table('drm_orders_new')
                // ->join('drm_order_products', 'drm_orders_new.id', '=', 'drm_order_products.drm_order_id')
                // ->select('drm_orders_new.order_id_api', 'drm_order_products.name', 'drm_order_products.amount', 'drm_orders_new.invoice_number', 'drm_orders_new.order_date', 'drm_orders_new.status', 'drm_orders_new.id as drm_orders_id', 'drm_orders_new.created_at')
                ->where('trash', '=', 'No')
                ->latest('drm_orders_new.order_date')
                ->take(10)
                ->get();

            //dd($data['latest_order']);

            /**Total orders Value*/
            $data['t_orders'] = DB::table('drm_orders_new')
                ->where('trash', '=', 'No')
                ->sum('total');
            //dd($data['t_orders']);

            /**Total Shipped orders */
            $data['shipped_orders'] = DB::table('drm_orders_new')
                ->where('status', '=', 'shipped')
                ->where('trash', '=', 'No')
                ->count();
            //dd($data['shipped_orders']);

            /**Total Number of Customers Per User*/
            $data['total_customer'] =  DB::table('drm_customers')
                ->count();

            //dd($data['total_customer']);

            $data['total_user'] =  DB::table('cms_users')
                ->count();


            $data['total_subscription'] =  DB::table('subscriptions')
                ->count();


            //dd($data['total_user']);

            /**Total Canceled orders */
            // $data['orders_cancel'] =  DB::table('drm_orders_new')
            //         ->where('status','=','Canceled')
            //         ->where('trash', '=', 'No')
            //         ->count();
            //dd($data['orders_cancel']);

            /* Total products */
            // $data['t_products'] = DB::table('drm_products')
            //     ->whereNull('deleted_at')
            //     ->whereNotNull('drm_import_id')
            //     ->count();
            $product_de = DB::table('drm_products')
                ->join('drm_translation_de', 'drm_products.id', '=', 'drm_translation_de.product_id')
                ->whereNull('deleted_at')
                ->count();

            $product_en = DB::table('drm_products')
                ->join('drm_translation_en', 'drm_products.id', '=', 'drm_translation_en.product_id')
                ->whereNull('deleted_at')
                ->count();

            $data['t_products'] = $product_de + $product_en;
            //dd($data['t_products']);

        } else {



            //Admin Part 1

            /* Selecting Latest 10 Orders */
            $data['latest_order'] = DB::table('drm_orders_new')
                // ->join('drm_order_products', 'drm_orders_new.id', '=', 'drm_order_products.drm_order_id')
                // ->select('drm_orders_new.order_id_api', 'drm_order_products.name', 'drm_order_products.amount', 'drm_orders_new.invoice_number', 'drm_orders_new.order_date', 'drm_orders_new.status', 'drm_orders_new.id as drm_orders_id', 'drm_orders_new.created_at')
                ->where('drm_orders_new.cms_user_id', '=', CRUDBooster::myId())
                ->latest('drm_orders_new.order_date')
                ->take(10)
                ->get();

            //dd($data['latest_order']);

            $uId = CRUDBooster::myId();
            //dd($uId);

            /* Total orders Per User */
            $data['t_orders'] = DB::table('drm_orders_new')
                ->where('cms_user_id', '=', $uId)
                ->get()
                ->sum('total');;
            //dd($data['t_orders']);

            /* Total Shipped orders */
            $data['orders'] = DB::table('drm_orders_new')
                ->where('status', '=', 'shipped')
                ->where('cms_user_id', '=', $uId)
                ->count();

            //dd($data['orders']);

            /* Total Number of Customers Per User*/
            $data['total_customer'] =  DB::table('drm_customers')
                ->where('user_id', '=', $uId)
                ->count();


            $data['total_subscription'] =  DB::table('subscriptions')
                ->count();


            /* Total Canceled orders */
            // $data['orders_cancel'] =  DB::table('drm_orders_new')
            //                             ->where('status','=','Canceled')
            //                             ->where('cms_user_id','=',$uId)
            //                             ->get()
            //                             ->count();

            //     dd($data['orders_cancel']);


            /**Total products Per User */
            /* $data['t_products'] = DB::table('drm_products')
                            ->where('user_id','=',$uId)
                            ->wherenull('deleted_at')
                            ->wherenotnull('drm_import_id')
                            ->get()
                            ->count(); */
            $total_de_products = DB::table('drm_products')
                ->join('drm_translation_de', 'drm_translation_de.product_id', '=', 'drm_products.id')
                ->where('drm_products.user_id', '=', $uId)->wherenull('drm_products.deleted_at')
                //->wherenotnull('drm_products.drm_import_id')
                ->count();

            $total_en_products = DB::table('drm_products')
                ->join('drm_translation_en', 'drm_translation_en.product_id', '=', 'drm_products.id')
                ->where('drm_products.user_id', '=', $uId)->wherenull('drm_products.deleted_at')
                //->wherenotnull('drm_products.drm_import_id')
                ->count();

            $data['t_products'] = $total_de_products + $total_en_products;

            //dd($data['t_orders']);
            //dd(number_format($data['t_orders'],2));

            /* Selecting 8 Best Sold product */
            $data['products'] = DB::table('drm_products')
                ->select('drm_products.id', 'drm_products.image', 'drm_products.name', DB::raw('COUNT(drm_products.ean) as count'))
                ->where('drm_products.user_id', '=', $uId)
                ->groupBy('drm_products.ean')
                ->orderBy('count', 'desc')
                ->take(8)
                ->get();
            //dd($data['products']);


            /* Users Shop */
            $data['shop_names'] = DB::table('gambio_shop')
                ->join('drm_orders_new', 'gambio_shop.id', '=', 'drm_orders_new.shop_id')
                ->select('gambio_shop.shopName as label', 'gambio_shop.id', 'drm_orders_new.order_id_api', DB::raw('COUNT(drm_orders_new.shop_id) as count'))
                ->where('gambio_shop.userid', '=', $uId)
                ->groupBy('drm_orders_new.shop_id')
                ->get();

            //dd(json_encode($data['shop_names']));

            $allshop = array();

            $data['color'] = [
                'green', 'red', 'yellow', 'aqua', 'light-blue', 'gray'
            ];

            if (count($data['shop_names']) > 0) {
                $shop_data = array();
                foreach ($data['shop_names'] as $key => $value) {
                    //dd($value);
                    $shop_data['color'] = $data['color'][$key];
                    $shop_data['value'] = $value->count;
                    $shop_data['label'] = $value->label;
                    $shop_data['highlight'] = $data['color'][$key];
                    $allshop[] = $shop_data;
                }
            }

            if (empty($allshop)) {

                $allshop = array(
                    array('color' => '#F7464A', 'value' => '300', 'label' => 'green', 'highlight' => '#FF5A5E'),
                    array('color' => '#46BFBD', 'value' => '50', 'label' => 'red', 'highlight' => '#5AD3D1'),
                    array('color' => '#FDB45C', 'value' => '100', 'label' => 'yellow', 'highlight' => '#FFC870'),
                    array('color' => '#949FB1', 'value' => '40', 'label' => 'aqua', 'highlight' => '#A8B3C5'),
                    array('color' => '#4D5360', 'value' => '120', 'label' => 'light-blue', 'highlight' => '#616774'),
                    array('color' => '#a9a9a9', 'value' => '60', 'label' => 'gray', 'highlight' => '#612374')
                );
            }

            $data['allshop'] = $allshop;
            //dd($data['allShop']);

            /* Selecting Best Sold Catagory */
            $data['categories'] = DB::table('drm_products')
                ->join('drm_orders_new', 'drm_products.user_id', '=', 'drm_orders_new.cms_user_id')
                ->select('drm_products.id', 'drm_products.category', 'drm_products.description', 'drm_products.image', 'drm_products.vk_price', DB::raw('COUNT(drm_products.category) as count'))
                ->where('drm_products.user_id', '=', $uId)
                ->groupBy('drm_products.category')
                ->orderBy('count', 'desc')
                ->take(10)
                ->get();

            //dd($data['categories']);


            /* Fetching Manual Notification */
            $data['notification'] = DB::table('manual_notification')
                ->select('id', 'title', 'description')
                ->where('publish', '=', 1)
                ->orderBy('id', 'DESC')
                ->get();
        }


        $data['page_title'] = 'Hola ' . CRUDBooster::myName() . '! Viel Freude und gute Geschäfte mit deinem Dropshipping Resource Management System!';
        // https://drm.software/admin/gorilla_products
        // return redirect('https://drm.software/admin/drm_products');
        if (CRUDBooster::myPrivilegeName() == 'Customer') {
            return view('admin.dashboard.admin', $data);
        } elseif (CRUDBooster::isSuperadmin()) {

            return view('admin.dashboard.admin1', $data);
        } else {
            $url = CRUDBooster::adminPath('drm_products');
            return redirect($url);
        }
    }

    public function getLockscreen()
    {

        if (!CRUDBooster::myId()) {
            Session::flush();

            return redirect()->route('getLogin')->with('message', trans('crudbooster.alert_session_expired'));
        }

        Session::put('admin_lock', 1);

        return view('crudbooster::lockscreen');
    }

    public function postUnlockScreen()
    {
        $id = CRUDBooster::myId();
        $password = Request::input('password');
        $users = DB::table(config('crudbooster.USER_TABLE'))->where('id', $id)->first();

        if (\Hash::check($password, $users->password)) {
            Session::put('admin_lock', 0);

            return redirect(CRUDBooster::adminPath());
        } else {
            echo "<script>alert('" . trans('crudbooster.alert_password_wrong') . "');history.go(-1);</script>";
        }
    }

    public function getLogin()
    {

        if (CRUDBooster::myId()) {
            return redirect(CRUDBooster::adminPath());
        }


        return view('crudbooster::login');
    }

    public function postLogin()
    {

        $validator = Validator::make(Request::all(), [
            'email' => 'required|email|exists:' . config('crudbooster.USER_TABLE'),
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->all();

            return redirect()->back()->with(['message' => implode(', ', $message), 'message_type' => 'danger']);
        }

        $email = Request::input("email");
        $password = Request::input("password");
        $users = DB::table(config('crudbooster.USER_TABLE'))->where("email", $email)->first();

        $match = Explode("@", ($users->email))[1];

        if ($users->status) {
            if (\Hash::check($password, $users->password)) {

                if ($users->two_fa_status == "Activate") {
                    if ($users->id_cms_privileges == 3 && $match != "gmx.de" && $match != "web.de" && $match != "gmx.at" && $match != "gmx.net") {
                        $users = DB::table(config('crudbooster.USER_TABLE'))->where("email", $email)->update([
                            'two_factor_code' => rand(100000, 999999),
                            'two_factor_expires_at' => now()->addMinutes(10),
                        ]);
                        $user = CRUDBooster::first(config('crudbooster.USER_TABLE'), ['email' => g('email')]);

                        // CRUDBooster::sendEmail(['to' => $user->email, 'data' => $user, 'template' => 'login_code']);
                        $postdata = [

                            'name' => $user->name,
                            'email' => $user->email,
                            'two_factor_code' => $user->two_factor_code,

                        ];

                        Mail::to($user->email)->send(new TwoFactorAuth($postdata));
                        return redirect()->action('TowFactorController@verifyToken');
                    }
                }
                $priv = DB::table("cms_privileges")->where("id", $users->id_cms_privileges)->first();

                $roles = DB::table('cms_privileges_roles')->where('id_cms_privileges', $users->id_cms_privileges)->join('cms_moduls', 'cms_moduls.id', '=', 'id_cms_moduls')->select('cms_moduls.name', 'cms_moduls.path', 'is_visible', 'is_create', 'is_read', 'is_edit', 'is_delete')->get();

                $photo = ($users->photo) ? asset($users->photo) : asset('vendor/crudbooster/avatar.jpg');
                Session::put('logged_as', 0);
                Session::put('admin_id', $users->id);
                Session::put('admin_is_superadmin', $priv->is_superadmin);
                Session::put('admin_is_developer', $priv->is_dev);
                Session::put('admin_name', $users->name);
                Session::put('admin_photo', $photo);
                Session::put('admin_privileges_roles', $roles);
                Session::put("admin_privileges", $users->id_cms_privileges);
                Session::put('admin_privileges_name', $priv->name);
                Session::put('admin_lock', 0);
                Session::put('theme_color', $priv->theme_color);
                Session::put("appname", CRUDBooster::getSetting('appname'));

                CRUDBooster::insertLog(trans("crudbooster.log_login", ['email' => $users->email, 'ip' => Request::server('REMOTE_ADDR')]), '', 'login');

                $cb_hook_session = new \App\Http\Controllers\CBHook;
                $cb_hook_session->afterLogin();

                return redirect(CRUDBooster::adminPath());
            } else {
                return redirect()->route('getLogin')->with('message', trans('crudbooster.alert_password_wrong'));
            }
        } else {
            return redirect()->route('getLogin')->with('message', 'Your account has been suspended. Please contact our support at info@expertise.rocks to get a new activation.');
        }
    }

    public function getForgot()
    {
        if (CRUDBooster::myId()) {
            return redirect(CRUDBooster::adminPath());
        }

        return view('crudbooster::forgot');
    }

    public function postForgot()
    {
        $match = Explode("@", ($_POST['email']))[1];

        if ($match != "gmx.de" && $match != "web.de" && $match != "gmx.at" && $match != "gmx.net") {


            $validator = Validator::make(Request::all(), [
                'email' => 'required|email|exists:' . config('crudbooster.USER_TABLE'),
            ]);

            if ($validator->fails()) {
                $message = $validator->errors()->all();

                return redirect()->back()->with(['message' => implode(', ', $message), 'message_type' => 'danger']);
            }

            $users = DB::table(config('crudbooster.USER_TABLE'))->where("email", $_POST['email'])->update([
                'forget_password_token' => $_POST['_token'],
            ]);

            $user = CRUDBooster::first(config('crudbooster.USER_TABLE'), ['email' => g('email')]);

            $postdatas = [

                'name' => $user->name,
                'email' => $user->email,
                'forget_password_token' => $user->forget_password_token,

            ];

            Mail::to($user->email)->send(new ForgetPassword($postdatas));
            return CRUDBooster::redirectBack("Please Check your Mail inbox, a password reset link is send from our system. If you not find it inbox, please check your mail spam option.!", "success");
        } else {

            return CRUDBooster::redirectBack("Please Contact with DRM Team!", "success");
        }
    }

    public function getLogout()
    {

        $me = CRUDBooster::me();
        CRUDBooster::insertLog(trans("crudbooster.log_logout", ['email' => $me->email]), '', 'logout');

        Session::flush();
        setcookie('user_id', session('admin_id'), time() - 1000);
        setcookie('user_name', session('admin_name'), time() - 1000);

        return redirect()->route('getLogin')->with('message', trans("crudbooster.message_after_logout"));
    }

    public function getFind()
    {

        $product_find = $_REQUEST['search'];

        /* Orders */
        $orders = DB::table('drm_orders_new')
            ->join('drm_customers', 'drm_orders_new.drm_customer_id', '=', 'drm_customers.id')
            ->join('drm_order_products', 'drm_orders_new.id', '=', 'drm_order_products.drm_order_id')
            ->select('drm_orders_new.id', 'drm_orders_new.order_id_api', 'drm_customers.full_name', 'drm_customers.email', 'drm_order_products.name')
            ->where('drm_orders_new.cms_user_id', '=', CRUDBooster::myId());

        //dd($orders->get());
        //dd(CRUDBooster::myId());

        if (isset($product_find)) {
            $orders->where(function ($query) use ($product_find) {
                $query->where('drm_orders_new.id', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_orders_new.order_id_api', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_customers.full_name', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_customers.email', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_order_products.name', 'LIKE', '%' . $product_find . '%');
            });
        }

        //dd($orders->get());

        $data['search_order'] = $orders->latest('drm_orders_new.order_date')->take(20)->get();

        //dd($data['search_order']);


        /* Customers */
        $customer = DB::table('drm_customers')
            ->select('id', 'full_name', 'email')
            ->where('drm_customers.user_id', '=', CRUDBooster::myId());

        //dd($customer->get());
        //dd(CRUDBooster::myId());

        if (isset($product_find)) {
            $customer->where(function ($query) use ($product_find) {
                $query->where('full_name', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('email', 'LIKE', '%' . $product_find . '%');
            });
        }

        //dd($customer->get());

        $data['search_customer'] = $customer->take(20)->get();

        //dd($data['search_customer']);


        /* Products */
        $products = DB::table('drm_products')
            ->join('countries', 'drm_products.country_id', '=', 'countries.id')
            ->select('drm_products.id as products_id', 'drm_products.name as products_name', 'drm_products.ean', 'countries.language as language_name')
            ->where('drm_products.user_id', '=', CRUDBooster::myId());
        //dd(CRUDBooster::myId());

        if (isset($product_find)) {
            $products->where(function ($query) use ($product_find) {
                $query->where('drm_products.name', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_products.ean', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('countries.language', 'LIKE', '%' . $product_find . '%');
            });
        }

        $data['search_product'] = $products->latest('drm_products.created_at')->take(20)->get();
        //dd($data['search_product']);

        return view("admin/dashboard/search", $data);
    }

    public function getFindAll()
    {

        $product_find = $_REQUEST['search'];
        /* Orders */
        $orders = DB::table('drm_orders_new')
            ->join('drm_customers', 'drm_orders_new.drm_customer_id', '=', 'drm_customers.id')
            ->join('drm_order_products', 'drm_orders_new.id', '=', 'drm_order_products.drm_order_id')
            ->select('drm_orders_new.id', 'drm_orders_new.order_id_api', 'drm_customers.full_name', 'drm_customers.email', 'drm_order_products.name');

        //dd($orders->get());
        //dd(CRUDBooster::myId());

        if (isset($product_find)) {
            $orders->where(function ($query) use ($product_find) {
                $query->where('drm_orders_new.id', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_orders_new.order_id_api', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_customers.full_name', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_customers.email', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_order_products.name', 'LIKE', '%' . $product_find . '%');
            });
        }

        //dd($orders->get());

        $data['search_order'] = $orders->latest('drm_orders_new.order_date')->get();

        //dd($data['search_order']);


        /* Customers */
        $customer = DB::table('cms_users')
            ->select('id', 'name', 'email');

        //dd($customer->get());
        //dd(CRUDBooster::myId());

        if (isset($product_find)) {
            $customer->where(function ($query) use ($product_find) {
                $query->where('name', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('email', 'LIKE', '%' . $product_find . '%');
            });
        }

        //dd($customer->get());

        $data['search_customer'] = $customer->get();

        //dd($data['search_customer']);


        /* Products */
        $products = DB::table('drm_products')
            ->join('countries', 'drm_products.country_id', '=', 'countries.id')
            ->select('drm_products.id as products_id', 'drm_products.name as products_name', 'drm_products.ean', 'countries.language as language_name')
            ->whereNull('drm_products.deleted_at');
        //dd(CRUDBooster::myId());

        if (isset($product_find)) {
            $products->where(function ($query) use ($product_find) {
                $query->where('drm_products.name', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('drm_products.ean', 'LIKE', '%' . $product_find . '%');
                $query->orWhere('countries.language', 'LIKE', '%' . $product_find . '%');
            });
        }

        $data['search_product'] = $products->latest('drm_products.created_at')->get();
        //dd($data['search_product']);

        return view("admin/dashboard/searchAll", $data);
    }

    public function search()
    {
        return view("admin.dashboard.search");
    }

    public function searchAll()
    {
        return view("admin.dashboard.searchAll");
    }

    public function getTargetValues()
    {
        $user = CRUDBooster::myId();
        $target_values = DB::table('drm_target')->where('user_id', $user)->first();
        return json_encode($target_values);
    }

    public function postSaveTargetValues()
    {
        $user = CRUDBooster::myId();
        $check =  DB::table('drm_target')->where('user_id', $user)->count();
        $data = [
            'target_order' =>  $_REQUEST['target_order_post'],
            'target_customer' =>  $_REQUEST['customer_value_post'],
            'target_shipped' =>  $_REQUEST['shipped_value_post'],
            'target_product' =>  $_REQUEST['product_value_post']
        ];

        if ($check) {
            DB::table('drm_target')->where('user_id', $user)->update($data);
        } else {
            $data['user_id'] = $user;
            DB::table('drm_target')->insert($data);
        }
    }
}
