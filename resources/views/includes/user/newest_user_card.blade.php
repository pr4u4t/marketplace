<div class="col-12 col-sm-6 col-lg-3">
    <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
        <a href="{{ route('user.show',$user)}}"><!-- Team Thumb-->
            <div class="advisor_thumb">
                <img loading="lazy" src="/default-avatar-600x600.webp" alt="">
                <!-- Social Info-->
                <div class="social-info">
                    <!--<a href="#">
                        <i class="fa fa-facebook"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-twitter"></i>
                    </a>
                    <a href="#">
                        <i class="fa fa-linkedin"></i>
                    </a>-->
                </div>
            </div>
            <!-- Team Details-->
            <div class="single_advisor_details_info">
                <h6>{{ $user->username }}</h6>
                <!--<p class="designation">Founder &amp; CEO</p>-->
            </div>
        </a>
    </div>
</div>
