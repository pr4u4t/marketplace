@if(isset($meta) and is_array($meta))
    @foreach($meta as $key => $value)
        <meta name="{{ $key }}" content="{{ $value }}" />
    @endforeach 
@endif
