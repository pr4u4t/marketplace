<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-lg-6">
            <!-- Section Heading-->
            <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                <h3>Newest Vendors</h3>
                <!--<p></p>-->
                <div class="line"></div>
            </div>
        </div>
    </div>
    
    <div class="row">
    @foreach($newestVendors as $vendor)
        @include('includes.vendor.newest_vendor_card',['vendor' => $vendor])
    @endforeach
    </div>
</div> 
