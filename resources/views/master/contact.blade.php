@extends('master.main')

@section('title','Contact')

@section('content')
@include('includes.breadcrumb',[
    'breadcrumb' => [
        'Home'      => '/',
        'Contact'   => route('contact')
    ]
])
<section class="mb-4 pt-4 contact">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    
    <p class="text-center w-responsive mx-auto mb-5">
    Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
    a matter of hours to help you.
    </p>
    
    <h3 class="h3-responsive font-weight-bold mb-3"> Use bitmessage directly: </h3>
    
    <p>
        <i class="fas fa-comment-alt me-3 fa-2x" style="vertical-align:middle"></i>
        <a href="bm:{{ $bm }}">{{ $bm }}</a>
    </p>
    
    <h3 class="h3-responsive font-weight-bold mt-2"> or this contact form:</h3>
    
    <div class="row">
        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="{{ route('contact.post') }}" method="POST">
            {{ csrf_field() }}
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <input type="text" id="name" name="name" class="form-control">
                        <label for="name" class="">Your name</label>
                    </div>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
            <div class="row">
            <!--Grid column-->
            <div class="col-md-6">
                <div class="md-form mb-0">
                    <select name="communicator" id="communicator" class="form-control">
                        <option value="jabber">xmpp/jabber</option>
                        <option value="email">e-mail</option>
                        <option value="whatsapp">whatsapp</option>
                        <option value="telegram">telegram</option>
                        <option value="wickr">wickr</option>
                        <option value="bitmessage">bitmessage</option>
                    </select>
                    <label for="communicator" class="">Your communicator</label>
                </div>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-md-6">
                <div class="md-form mb-0">
                    <input type="text" id="email" name="email" class="form-control">
                    <label for="email" class="">Your address</label>
                </div>
            </div>
            <!--Grid column-->
            </div>
            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <input type="text" id="subject" name="subject" class="form-control">
                        <label for="subject" class="">Subject</label>
                    </div>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">
            <!--Grid column-->
                <div class="col-md-12">

                    <div class="md-form">
                        <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                        <label for="message">Your message</label>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    @include('includes.captcha')
                </div>
            </div>
            <!--Grid row-->
            
                <div class="text-center text-md-left">
                    <button class="btn btn-primary">Send</a>
                </div>
            </form>

            @include('includes.pgp',[
            'title'     => 'Admin PGP Key',
            'pgp'       => $admin_pgp,
            'pgp_path'  => $admin_pgp_path
            ])
            
            @include('includes.pgp',[
                'title'     => 'Site PGP Key',
                'pgp'       => $market_pgp,
                'pgp_path'  => $market_pgp_path
            ])
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li>
                    <i class="fas fa-envelope me-3 fa-2x"></i>
                    <p>
                        <a href="mailto:{{ $mail }}"> {{ $mail }}</a>
                    </p>
                </li>
                <li>
                    <i class="fas fa-lightbulb fa-2x"></i>
                    <p>
                        <a href="xmpp:{{ $xmpp }}">{{ $xmpp }}</a>
                    </p>
                </li>
            </ul>
        </div>
        <!--Grid column-->
    </div>
</section>
<!--Section: Contact v.2-->
@stop
