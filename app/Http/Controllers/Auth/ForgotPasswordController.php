<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\RequestException;
use App\Http\Requests\Auth\RecoverPasswordPgpRequest;
use App\Http\Requests\Auth\ResetPasswordPgpRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecoverPasswordMnemonicRequest;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    public function showForget(){
        return (Auth::check()) ? redirect()->back() : view('auth.forgotpassword.forgotpassword')->with([
            'xmpp'  => config('app.xmpp'),
            'mail'  => config('app.email')
        ]);
    }

    public function showMnemonic(){
        return (Auth::check()) ? redirect()->back() : view('auth.forgotpassword.mnemonicpassword')->with([
            'xmpp'  => config('app.xmpp'),
            'mail'  => config('app.email')
        ]);
    }

    public function showPGP(){
        return (Auth::check()) ? redirect()->back() : view('auth.forgotpassword.pgppassword')->with([
            'xmpp'  => config('app.xmpp'),
            'mail'  => config('app.email')
        ]);
    }

    public function resetMnemonic(RecoverPasswordMnemonicRequest $request){
        try{
            return $request->persist();
        } catch (RequestException $e){
            session()->flash('errormessage', $e->getMessage());
            return redirect()->back();
        }
    }

    public function sendVerify(RecoverPasswordPgpRequest $request){
        try{
            return $request->persist();
        } catch (RequestException $e){
            session()->flash('errormessage', $e->getMessage());
            return redirect()->back();
        }
    }

    public function showVerify(){
        return (Auth::check()) ? redirect()->back() : view('auth.forgotpassword.pgppasswordverify')->with([
            'xmpp'  => config('app.xmpp'),
            'mail'  => config('app.email')
        ]);
    }

    public function resetPgp(ResetPasswordPgpRequest $request){
        try{
            return $request->persist();
        } catch (RequestException $e){
            session()->flash('errormessage', $e->getMessage());
            return redirect()->back();
        }
    }
}
