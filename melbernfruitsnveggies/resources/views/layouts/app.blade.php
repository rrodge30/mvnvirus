

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    
    <title>{{ config('app.name', 'MELBERN FRUITS N VEGGIES') }}</title>
    
    <!-- Scripts -->
    {{-- <script src="{{ asset('public/js/app.js') }}" defer></script> --}}
    
    


    {{-- bootstrap --}}
    {{-- <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}" type="text/css"> --}}
    <!-- Fonts -->
    <script src="{{asset('public/js/jquery-3.1.0.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}" type="text/css">
    
    <script src="{{ asset('public/js/dataTables.js') }}"></script>       
    <script src="{{ asset('public/js/dataTables-bootstrap4.js') }}"></script>       
    <link href="{{ asset('public/css/dataTables-bootstrap4.css') }}" rel="stylesheet">

    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/material-icons.css') }}" rel="stylesheet">

    {{-- custom --}}
    <link href="{{ asset('public/css/material-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
    {{-- scripts --}}
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/js/sweetalert.min.js')}}"></script>

    {{-- fonts --}}
    <link rel="stylesheet" href="{{asset('public/css/fonts/Raleway-Bold.ttf')}}" type="text/ttf">
    <link rel="stylesheet" href="{{asset('public/css/fonts/Raleway-ExtraBold.ttf')}}" type="text/ttf">
    <link rel="stylesheet" href="{{asset('public/css/fonts/Raleway-Heavy.ttf')}}" type="text/ttf">
    <link rel="stylesheet" href="{{asset('public/css/fonts/Raleway-Light.ttf')}}" type="text/ttf">
    <link rel="stylesheet" href="{{asset('public/css/fonts/Raleway-Medium.ttf')}}" type="text/ttf">
    <link rel="stylesheet" href="{{asset('public/css/fonts/Raleway-Regular.ttf')}}" type="text/ttf">
    <link rel="stylesheet" href="{{asset('public/css/fonts/Raleway-SemiBold.ttf')}}" type="text/ttf">
    <link rel="stylesheet" href="{{asset('public/css/fonts/Raleway-Thin.ttf')}}" type="text/ttf">

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif !important;
            font-weight: 100 !important;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px !important;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 15px !important;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .show{
            transition: all 1ms ease-in-out;
        }

    </style>
</head>
<body>
    
    <div id="app">
        
        @include('layouts.nav')
        @include('alerts.logmsg')

        <main class="py-4">
            <div class="container-fluid">

                @yield('content')
            </div>
        </main>
    </div>

    {{-- MODALS --}}
    <div class="modal fade" id="modal-center-dialog" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-center-dialog-header"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-center-dialog-body">
                
            </div>
            <div class="modal-footer" id="modal-center-dialog-footer">
                
            </div>
            </div>
        </div>
    </div>

    {{-- LONG CONTENT MODAL --}}
    <div class="modal fade" id="modal-long-content" tabindex="-1" role="dialog" aria-labelledby="modalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalLongTitle"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
                
            </div>
          </div>
        </div>
    </div>

</body>
</html>
