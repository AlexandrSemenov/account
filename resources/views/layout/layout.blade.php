<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Account app</title>
    <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/jquery-ui.min.css')}}">
    <style>
        th{
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li id="exchange" class="navbar-text" style="cursor: pointer">Автопересчет</li>
                    @if(Auth::check())
                        <li><a href="{{route('transaction.create')}}">Добавить операцию</a></li>
                        <li class="navbar-text">{{ Auth::user()->name }}</li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('login.register') }}">Register</a></li>
                    @endif
                </ul>
            </div><!-- /.nav-collapse -->
        </div><!-- /.container -->
    </nav>
    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('assets/js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $( function() {
            $( '#datepicker, #datepicker2' ).datepicker();
        } );

        var sale = $('.sale').html();
        $('.sale').remove();

        var index = 0;


        $('#exchange').on('click', function(){
            if(index == 0){
                $('tbody tr').each(function(){
                    var item = $(this).children('td:nth-child(5)').html();
                   $(this).children('td:nth-child(5)').html((item / sale).toFixed(2));
                });
                $total =  $('#total th:nth-child(2)').html();
                $('#total th:nth-child(2)').html(($total / sale).toFixed(2));
                index = 1;
            }
        });

    </script>
</body>
</html>