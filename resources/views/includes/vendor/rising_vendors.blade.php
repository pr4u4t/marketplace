<div class="row rising-vendors-block">
    <div class="container">
        <div class="col-md-12">
            <h4 style="text-align:center">
            Rising vendors
            </h4>
            <hr class="col-9 d-md-none">
            @foreach($risingVendors as $vendor)
                <table class="table table-borderless table-hover">
                    <tr>
                        <td>
                            <a href="{{route('vendor.show',$vendor)}}"
                        style="text-decoration: none; color:#212529">{{$vendor->user->username}}</a>
                        </td>
                    
                    <td class="text-right">
                    <span class="btn btn-sm @if($vendor->vendor->experience >= 0) btn-primary @else btn-danger @endif active"
                    style="cursor:default">Level {{$vendor->getLevel()}}</span>
                    </td>
                    </tr>
                </table>
            @endforeach
        </div>
    </div>
</div> 
