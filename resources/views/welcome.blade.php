<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>หจก. มัทนาไข่สดฟาร์ม</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
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
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         ออกจากระบบ
                     </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf

                        </form>
                        
                    @else
                        <a href="{{ route('login') }}">ลงชื่อเข้าใช้งาน</a>

                       
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    หจก. มัทนาไข่สดฟาร์ม
                </div>

                <div class="links">
                    <a href="#">ข้อมูลติดต่อ 098-658-9288</a>
                    <a href="https://www.facebook.com/mnt.farm/" target="_blank">Facebook หจก. มัทนาไข่สดฟาร์ม</a>
                    <a  target="_blank" href="https://www.facebook.com/mnt.farm/photos/a.725089274289282/1936714136460117/?type=3&eid=ARCxUQVUa92eg6Rx_o6pRwQ-J746Rm3pIsIEx_30MCM6OeW6G48Qgx4HVLmc2iqVpfOHQHvXgPh86KVW&__xts__%5B0%5D=68.ARCLKKpP8IPbTTH5j3lAaHp1S9Z5iAcOJasYvo_wllnKZ1pawmsTZbDamBz6FtCGy2HwR8STKMa6tHfldaEE_jG7OuwagEO5WqStj_r0WBa9evD3_VdY0P9BcaEum7O7KH_d2ljK0KVqmYcgrZgRSqGClH77PgPBMg0TDJaO-UrBEM1TzMeO3pDqTedhP9-tjoxXOemw_ablDAw2cTJd8SMqITJOTcpRDJuWqnTEN1XXqfiDWCsjOIV2JCZ05Besekx7VYLE2_65QDmeFwgFu6tdVIJfnA7QJvl6n3lMOv6iAX3RBrYtH1cJm7Xxc-szImRNvqmsI9RZds37JXiLFGCWOw&__tn__=EEHH-R">Line id:098-658-9288</a>
                    {{-- <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a> --}}
                </div>
            </div>
        </div>
    </body>
</html>
