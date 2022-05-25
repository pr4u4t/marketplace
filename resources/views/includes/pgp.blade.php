<div class="jumbotron mt-4">
    @if(isset($title))
        <h1 class="display-4">{{ $title }}</h1>
    @endif
<p class="lead" style="overflow:scroll">
    @if(!empty($pgp))
        <pre>{{ $pgp }}</pre>
    @else
        <span>None ;( </span>
    @endif
</p>
    @if(isset($pgp_path))
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="{{ $pgp_path }}" role="button">Download</a>
        </p>
    @endif
</div>
