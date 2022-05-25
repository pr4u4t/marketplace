{{-- Breadcrumbs --}}
<nav class="main-breadcrumb" aria-label="breadcrumb">
    <ol class="breadcrumb">
        @foreach($breadcrumb as $name => $path)
            <li class="breadcrumb-item" aria-current="page"><a href="{{ $path }}">{{ $name }}</a></li>
        @endforeach
    </ol>
</nav> 
