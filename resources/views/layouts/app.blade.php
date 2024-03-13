<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bar POS">
    <meta name="author" content="B2B">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <title>{{getStoreName()}}</title>
    <link class="js-stylesheet" href="{{ asset('/assets/css/light.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/js/toastr.min.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{getFavIcon()}}">
     <style>
        /* Hide the print button when printing */
        @media print {
            .d-n-p {
                display: none;
            }
        }
    </style>
    @stack('css')
    @livewireScripts()
    @livewireStyles()
</head>
<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        <livewire:components.sidebar />
        <div class="main">
            <livewire:components.header>
                <main class="content p-3">
                    <div class="container-fluid p-0">
                        {{ $slot }}
                    </div>
                </main>
        </div>
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/assets/js/app.js') }}"></script>
    <script src="{{ asset('/assets/js/toastr.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script type="text/javascript">
    "use strict";
       
       $(document).ready(function () {
            $('.print').on('click', function () {
                window.print();
                setTimeout(function() {
                    window.close();
                }, 1);
            });
        });
   </script>
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
        $(document).ready(function () {
            $('#table').DataTable();
        });
        $('#table').dataTable({
            "lengthMenu": [15, 25, 50, 100]
        });

        document.addEventListener('livewire:load', function () {
            Livewire.on('initDataTables', function () {
                $('#table').DataTable();
            });
        });
    </script>
    @stack('script')
</body>
</html>
