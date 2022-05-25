<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Illuminate\Support\Facades\View;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception){
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception){
        if ($exception instanceof RequestException){
            $exception->flashError();
            return redirect()->back();
        }

        if($exception instanceof TokenMismatchException){
            session()->flash('errormessage', 'Token missmatch');
            return redirect()->back();
        }

        if($this->isHttpException($exception)){
            switch ($exception->getStatusCode()){
              case '404':
                    return response(view('errors.404')->with([
                        'mail'  => config('app.mail'),
                        'xmpp'  => config('app.xmpp')
                    ]),404);
                    
                case '403':
                    return response(view('errors.403')->with([
                        'mail'  => config('app.mail'),
                        'xmpp'  => config('app.xmpp')
                    ]),403);
                    
                default:
                    return $this->renderHttpException($exception);
          }
        }
        
        return parent::render($request, $exception);
    }
}
