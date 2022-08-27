@if (Auth::check() or config('app.public'))
<footer id="mfooter" style="border-top: 1px solid #dee2e6 !important;" class="text-center text-lg-start bg-light text-muted">

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
            <!-- Grid column -->
                <div class="col-md-12 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                    <img loading="lazy" style="width:4em;" src="{{ config('app.logo') }}">
		    {{ $footer_title }}
                    </h6>
                    <p>
                    Aiming to be the biggest and trusted market on the darknet.
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                    Our Policy
                    </h6>
                    <p>
                    <a href="{{ route('legals.terms') }}" class="text-reset"> Terms </a>
                    </p>
                    <p>
                    <a href="{{ route('legals.faq') }}" class="text-reset"> FAQ </a>
                    </p>
                    {{--<p>
                    <a href="{{ route('legals.mission') }}" class="text-reset"> Mission </a>
                    </p>--}}
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-6 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Official mirrors
                    </h6>
                    @php $i = 1; @endphp
                    @foreach(config('marketplace.mirrors') as $mirror)
                    <p>
                        <a href="{{$mirror}}" class="text-reset">Mirror #{{ $i }}</a>
                        @php ++$i; @endphp
                    </p>
                    @endforeach
                </div>
                

                <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 col-xl-3 mx-auto mb-md-0 mb-4 contact">
                    <h6 class="text-uppercase fw-bold mb-4">
                        <a href="{{ route("contact") }}">Contact</a>
                    </h6>
                    <!--<p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p> -->
                    <p>
                        <i class="fas fa-comment-alt me-3"></i>
                        <a href="bm:{{ $bm }}">{{ $bm }}</a>
                    </p>
                    <p>
                        <i class="fas fa-envelope me-3"></i>
                        <a href="mailto:{{ $mail }}">{{ $mail }}</a>
                    </p>
                    <p>
                        <i class="fas fa-lightbulb"></i>
                        <a href="xmpp:{{ $xmpp }}">{{ $xmpp }}</a>
                    </p>

                </div>
            <!-- Grid row -->
            </div>
        </div>
    </section>

    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        © 2022 Copyright:
        <span class="text-reset fw-bold"> {{ config('app.title') }} </span>
    </div>
</footer>

@endif
