<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\RequestException;
use App\Http\Requests\Auth\VerifySinginRequest;
use App\Http\Requests\Auth\SignInRequest;
use App\Marketplace\Encryption\Cipher;
use App\Marketplace\Encryption\DecryptionKey;
use App\Marketplace\Encryption\EncryptionKey;
use App\Marketplace\Encryption\Keypair;
use App\Marketplace\Utility\Captcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Category;

class LoginController extends Controller {
    /**
     * Show view for sign in
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSignIn() {
        return (Auth::check()) ? redirect()->back() : view('auth.signin')->with([
            'captcha' 		=> Captcha::build(),
            'xmpp'    		=> config('app.xmpp'),
	    'mail'    		=> config('app.email'),
	    'bm'      		=> config('app.bm'),
	    'roots'   		=> Category::roots(),
	    'footer_title'  	=> config('app.footer_title')
        ]);
    }
    
    public function postSignIn(SignInRequest $request){
        try{
            return $request->persist();
        } catch (RequestException $e){
            session()->flash('errormessage', $e->getMessage());
            return redirect()->back();
        }
    }

    public function postSignOut(){
        auth()->logout();
        session()->flush();
        return redirect()->route('home');
    }

    /**
     * Display verify page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showVerify(){
        return view('auth.verify', [
            'xmpp'    		=> config('app.xmpp'),
	    'mail'    		=> config('app.email'),
	    'bm'      		=> config('app.bm'),
	    'roots'   		=> Category::roots(),
	    'footer_title'  	=> config('app.footer_title')
        ]);
    }

    /**
     * Accepet the validation string
     *
     * @param VerifySinginRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function postVerify(VerifySinginRequest $request){
        try{
            return $request -> persist();
        }
        catch (RequestException $exception){
            session() -> flash('errormessage', $exception->getMessage());
            return redirect() -> back();
        }
    }
}
