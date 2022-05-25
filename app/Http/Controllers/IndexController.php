<?php

namespace App\Http\Controllers;

use App\Category;
use App\Marketplace\Cart;
use App\Marketplace\FeaturedProducts;
use App\Marketplace\ModuleManager;
use App\Marketplace\Payment\Escrow;
use App\Marketplace\Payment\VergeCoin;
use App\Product;
use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Marketplace\Utility\Captcha;

/**
 * Controller for all always public routes
 *
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller{
    
    protected $ordering = [
        'by' => 'weight',
        'dir' => 'asc'
    ];
    
    /**
     * Handles the index page request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home() {
        return view('welcome', [
            'productsView'      => session()->get('products_view'),
            'newestProducts'    => Product::frontPage(),
            'categories'        => Category::roots($this->ordering['by'],$this->ordering['dir']),
            'featuredProducts'  => (!ModuleManager::isEnabled('FeaturedProducts')) ? null : FeaturedProducts::get(),
            'xmpp'              => config('app.xmpp'),
            'mail'              => config('app.email')
        ]);
    }

    public function categories() {
        return view('categories',[
            'categories'        => Category::roots($this->ordering['by'],$this->ordering['dir']),
            'xmpp'              => config('app.xmpp'),
            'mail'              => config('app.email')
        ]);
    }
    
    public function vendors() {
        return view('vendors',[
            'vendors'           => Vendor::allVendors(),
            'xmpp'              => config('app.xmpp'),
            'mail'              => config('app.email')
        ]);
    }
    
    /**
     * Redirection to sign in
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login() {
        return redirect()->route('auth.signin');
    }

    public function confirmation(Request $request) {
        return view('confirmation');
    }

    /**
     * Show category page
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category(Category $category) {
        return view('category', [
            'productsView'  => session()->get('products_view'),
            'category'      => $category,
            'products'      => $category->childProducts(),
            'categories'    => Category::roots($this->ordering['by'],$this->ordering['dir']),
            'parents'       => $category->parents(),
            'xmpp'          => config('app.xmpp'),
            'mail'          => config('app.email')
        ]);
    }

    public function shop(){
        return view('category', [
            'category'          => null,
            'productsView'      => session()->get('products_view'),
            'products'          => Product::allProducts(),
            'categories'        => Category::roots($this->ordering['by'],$this->ordering['dir']),
            'xmpp'              => config('app.xmpp'),
            'mail'              => config('app.email')
        ]);
    }
    
    /**
     * Show vendor page, 6 products, and 10 feedbacks
     *
     * @param Vendor $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendor(Vendor $user) {
        return view('vendor.index',[
            'pgp'           => $user->pgp_key,
            'vendor'        => $user->user,
            'xmpp'          => config('app.xmpp'),
            'mail'          => config('app.email'),
            'categories'    => Category::roots($this->ordering['by'],$this->ordering['dir'])
        ]);
    }
    
    
    /**
     * Show page with vendors feedbacks
     *
     * @param Vendor $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function vendorsFeedbacks(Vendor $user) {
        return view('vendor.feedback', [
            'vendor'        => $user->user,
            'feedback'      => $user->feedback()->orderByDesc('created_at')->paginate(20),
            'xmpp'          => config('app.xmpp'),
            'mail'          => config('app.email'),
            'categories'    => Category::roots($this->ordering['by'],$this->ordering['dir'])
        ]);
    }


    /**
     * Sets in session which view are we using
     *
     * @param $list
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setView($list){
        session()->put('products_view', $list);
        return redirect()->back();
    }
    
    public function contact(){
        return view('master.contact', [
            'admin_pgp'         => $this->adminPGP(),
            'admin_pgp_path'    => '/admin.asc',
            'market_pgp'        => $this->marketPGP(),
            'market_pgp_path'   => '/market.asc',
            'captcha'           => Captcha::build(),
            'xmpp'              => config('app.xmpp'),
            'mail'              => config('app.email'),
            'categories'        => Category::roots($this->ordering['by'],$this->ordering['dir'])
        ]);
    }
    
    public function adminPGP(){
        if(!file_exists(public_path().'/admin.asc')){
            return null;
        }
        
        $ret = config('app.cache') ? Cache::remember('pgp:admin',600,function(){
            return file_get_contents(public_path().'/admin.asc');
        }) : file_get_contents(public_path().'/admin.asc');
        
        return $ret;
    }
    
    public function marketPGP(){
        if(!file_exists(public_path().'/market.asc')){
            return null;
        }
        
        $ret = config('app.cache') ? Cache::remember('pgp:market',600,function(){
            return file_get_contents(public_path().'/market.asc');
        }) : file_get_contents(public_path().'/market.asc');
        
        return $ret;
    }
    
    public function postInfoMessage(){
    
        return redirect()->back();
    }
}
