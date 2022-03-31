<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @yield('title')

        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="{{ URL::asset('backend/css/bootstrap.css') }}" />

        <link rel="stylesheet" href="{{ URL::asset('backend/vendors/iconly/bold.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('backend/vendors/perfect-scrollbar/perfect-scrollbar.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('backend/vendors/bootstrap-icons/bootstrap-icons.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('backend/css/app.css') }}" />
        <link rel="stylesheet" href="{{ URL::asset('backend/css/style.css') }}" />
        {{-- <link rel="shortcut icon" href="{{ URL::asset('backend/images/favicon.svg') }}" type="image/x-icon" /> --}}
            
        <link rel="stylesheet" href="{{ URL::asset('backend/vendors/simple-datatables/style.css') }}">

        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp"/>

        <link rel="stylesheet" href="{{ URL::asset('backend/vendors/toastify/toastify.css') }}">

        <link rel="stylesheet" href="{{ URL::asset('backend/css/select2.min.css') }}">
    </head>

    <body>
        <div id="app">
            @include('admin.partials.slider-bar')
            <div id="main">
                @include('admin.partials.header')
                <div class="page-content">
                    @yield('content')
                </div>
                @include('admin.partials.footer')
            </div>
        </div>
        <script src="{{ URL::asset('backend/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ URL::asset('backend/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ URL::asset('backend/vendors/apexcharts/apexcharts.js') }}"></script>
        <script src="{{ URL::asset('backend/js/pages/dashboard.js') }}"></script>
        <script src="{{ URL::asset('backend/js/sweetalert2@11.js') }}"></script>
        <script src="{{ URL::asset('backend/js/main.js') }}"></script>
        {{-- <script src="{{ URL::asset('backend/js/loading.js') }}"></script> --}}
        <script src="{{ URL::asset('backend/js/scroll_top.js') }}"></script>
        <script src="{{ URL::asset('backend/js/select2.min.js') }}"></script>
  
        <!-- toastify -->
        <script src="{{ URL::asset('backend/vendors/toastify/toastify.js') }}"></script>

        <script src="{{ URL::asset('backend/vendors/tinymce/tinymce.min.js') }}"></script>
        <script src="{{ URL::asset('backend/vendors/tinymce/plugins/code/plugin.min.js')}}"></script>
        <script>
            tinymce.init({ selector: '#default' });
            tinymce.init({ selector: '#dark', toolbar: 'undo redo styleselect bold italic alignleft aligncenter alignright bullist numlist outdent indent code', plugins: 'code' });
        </script>
        <script src="{{ URL::asset('backend/vendors/simple-datatables/simple-datatables.js') }}"></script>
        <script>
            // Simple Datatable
            let table1 = document.querySelector('#table_category');
            let dataTable1 = new simpleDatatables.DataTable(table1);
        </script>
        <script>
            // Simple Datatable
            let table2 = document.querySelector('#table_product');
            let dataTable2 = new simpleDatatables.DataTable(table2);
        </script>
        <script>
            // Simple Datatable
            let table3 = document.querySelector('#table_discount');
            let dataTable3 = new simpleDatatables.DataTable(table3);
        </script>
    </body>
</html>
