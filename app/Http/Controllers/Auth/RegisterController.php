<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\SignUpRequest;
use App\Marketplace\Utility\Captcha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Category;

class RegisterController extends Controller {

    /**
     * Show view for sign up, if refid is provided pass it along
     * @param string $refid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSignUp($refid = '') {
        return (Auth::check()) ? redirect()->back() : view('auth.signup')->with([
            'refid'     => $refid,
            'captcha'   => Captcha::Build(),
            'xmpp'      => config('app.xmpp'),
            'mail'      => config('app.email'),
            'roots'     => Category::roots()
        ]);
    }


    /**
     * Try to complete SignUpRequest, if success redirect to mnemonic
     * if fail redirect back
     * @param SignUpRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signUpPost(SignUpRequest $request) {
        try {
            $request->persist();
            return redirect()->route('auth.mnemonic');
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back();
        }

    }

    /**
     * If there is mnemonic_key in session, show it to user, if not
     * redirect to signin page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function showMnemonic() {
        if (!session()->has('mnemonic_key'))
            return redirect()->route('auth.signin');
        
        return view('auth.mnemonic')->with([
            'mnemonic'  => session()->get('mnemonic_key'),
            'xmpp'      => config('app.xmpp'),
            'mail'      => config('app.email'),
            'roots'     => Category::roots()
        ]);
    }
}
