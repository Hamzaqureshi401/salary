<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SketchStack Pos">
    <meta name="author" content="SketchStack">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <link rel="canonical" href="index.html" />
    <title>{{getStoreName()}}</title>
    <link class="js-stylesheet" href="{{ asset('/assets/css/light.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/js/toastr.min.css') }}" rel="stylesheet">
    @livewireScripts()
    @livewireStyles()
</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    {{ $slot }}
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/assets/js/app.js') }}"></script>
    <script src="{{ asset('/assets/js/toastr.min.js') }}"></script>
    <script>
        "use strict"
        Livewire.on('closemodal', () => {
            $('.modal').modal('hide');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').removeAttr('style');
        })
    </script>
    <script>
        "use strict";
        Livewire.on('reloadpage', () => {
            window.location.reload();
        })
    </script>
    <script>
        "use strict";
        window.addEventListener('alert', event => {
            toastr[event.detail.type](event.detail.message, event.detail.title ?? '');
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });
        @if (Session::has('message'))
            toastr.info("{{ Session::get('message') }}");
        @endif
    </script>
<script>
    "use strict";
    window.addEventListener('swal-alert', event => {
        window.Swal.fire(
            event.detail.title,
            event.detail.message,
            event.detail.type
        )
    });
</script>

     <script>
        "use strict";
        Livewire.on('openmodal', (data) => {
            let modal = new bootstrap.Modal(document.getElementById(data),{});
            modal.show()
        })
    </script>
</body>
</html>