
	    <figure class="card card-product-grid card-lgi" style="overflow:hidden"> 
			<a href="{{ route('product.show', $product) }}" class="img-wrap" data-abc="true">
				<img loading="lazy" class="card-img-top" src="{{ asset('storage/'  . $product->frontImage()->image) }}" alt="{{ $product->name }}">
			</a>
                	
			<figcaption class="info-wrap">
				<div class="row">
					<div class="col-md-12"> 
						<a href="{{ route('product.show', $product) }}" class="title" data-abc="true">{{ $product -> name }}</a> 
					</div>
					<div class="col-md-12">
						Posted by <a href="{{ route('vendor.show', $product -> user) }}" class="badge badge-info">{{ $product -> user -> username }}</a>
							<div class="row">
								<div class="col-md-12 rating text-left"> <strong>{{ $product -> quantity }}</strong> left </div>
								<div class="col-md-12 rating text-right"> @include('includes.purchases.stars', ['stars' => (int)$product->avgRate('quality_rate')]) </div> 
							</div>
					</div>
			</figcaption>
			
			<div class="bottom-wrap"> 
				<!--<a href="#" class="btn btn-primary float-right" data-abc="true"> Buy now </a>-->
				<a href="{{ route('product.show', $product) }}" class="btn btn-primary d-block">Buy now</a>
                    		<div class="price-wrap"> <span class="price h5">From: <strong>{{ $product->getLocalPriceFrom() }} {{ \App\Marketplace\Utility\CurrencyConverter::getLocalSymbol() }}</strong></span> <br> <!--<small class="text-success">Free shipping</small>--> </div>
			</div>
		</figure>
