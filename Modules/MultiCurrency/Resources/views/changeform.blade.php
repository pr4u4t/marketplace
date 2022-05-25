<h3 class="mt-4">Change currency</h3>
    <hr>
    <form action="{{ route('profile.currency.change', [ 'id' => Auth::id() ]) }}" method="POST" class="justify-content-between">
	{{ csrf_field() }}
	<div class="form-row my-2">
	    <label class="col-form-label col-md-4" for="currency">Choose currency:</label>
	    <div class="col-md-8">
	        <select name="currency" id="currency" required class="form-control">
	            <option value="EUR" {{ Auth::user()->getLocalCurrency() === "EUR" ? "selected=\"true\"" : "" }} >EUR</option>
	            <option value="USD" {{ Auth::user()->getLocalCurrency() === "USD" ? "selected=\"true\"" : "" }} >USD</option>
		</select>
	    </div>
	</div>
	<div class="form-row text-right justify-content-between my-2">
	    <div class="col-md-12">
		<button type="submit" class="btn btn-outline-success"> Change currency </button>
	    </div>
	</div> 
    </form>

