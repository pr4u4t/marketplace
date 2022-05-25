@if(config('marketplace.js_warning') and auth()->user()->jswarn)
    <div class="mt-3">
        <div id="jswarning"></div>
    </div>
    <script>
        let warningText = "You have JavaScript enabled, you are putting yourself at risk! Please disable it immediately!\nYou can disable JS using browser plugin or disable this message in your profile."
        let jsWarning = document.getElementById('jswarning');
        let alert = document.createElement('div');
        let span = document.createElement('span');
        alert.classList.add('alert');
        alert.classList.add('alert-danger');
        span.innerText = warningText;
        alert.appendChild(span);
        jsWarning.appendChild(alert);
    </script>
@endif
