<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Order System</title>
        <meta name="description" content="Pushy is an off-canvas navigation menu for your website.">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('css/demo.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
        <!-- <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" /> -->
<!--         <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap.min.css') }}"> -->
        <link rel="stylesheet prefetch" href="{{ asset('css/bootstrap.min.css') }}">

        <!-- Pushy CSS -->
        <link rel="stylesheet" href="{{ asset('css/pushy.css') }}">
        
        <!-- jQuery -->
        <script src="{{ asset('js/jquery-1.10.2.min.js') }}"></script>
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/moment-with-locales.js') }}"></script>
        <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
        <script src="{{ asset('js/handlebars.min.js') }}"></script>
        
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> -->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script> -->
    </head>
    <body>

        <header class="site-header push">Order System</header>

        <!-- Pushy Menu -->
        <nav class="pushy pushy-left" data-focus="#first-link">
            <div class="pushy-content">
                <ul>
                    <?php
                    if(strtolower(Auth::user()->role->name) == 'super admin')
                    {
                        ?>
                    <li class="pushy-submenu">
                        <button>Daftar Harga</button>
                        <ul>
                            <li class="pushy-link"><a href="{{ route('folding_gate') }}">Folding Gate</a></li>
                            <li class="pushy-link"><a href="{{ route('folding_gate_sparepart') }}">Folding Gate Spare Part</a></li>
                            <li class="pushy-link"><a href="{{ route('rolling_door') }}">Rolling Door</a></li>
                            <li class="pushy-link"><a href="{{ route('rolling_door_sparepart') }}">Rolling Door Spare Part</a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    if(strtolower(Auth::user()->role->name) == 'super admin' || strtolower(Auth::user()->role->name) == 'admin kasir')
                    {
                    ?>
                    <li class="pushy-submenu">
                        <button id="first-link">Daftar Pesanan</button>
                        <ul>
                            <li class="pushy-link"><a href="{{ route('folding_gate_order') }}">Folding Gate</a></li>
                            <li class="pushy-link"><a href="{{ route('folding_gate_sparepart_order') }}">Folding Gate Spare Part</a></li>
                            <li class="pushy-link"><a href="{{ route('rolling_door_order') }}">Rolling Door</a></li>
                            <li class="pushy-link"><a href="{{ route('rolling_door_sparepart_order') }}">Rolling Door Spare Part</a></li>
                        </ul>
                    </li>
                    <?php
                    }
                    if(strtolower(Auth::user()->role->name) == 'super admin' || strtolower(Auth::user()->role->name) == 'admin gudang folding gate' || strtolower(Auth::user()->role->name) == 'admin gudang rolling door')
                            {
                    ?>
                    <li class="pushy-submenu">
                        <button id="first-link">Penerimaan Barang</button>
                        <ul>
                            <?php
                            if(strtolower(Auth::user()->role->name) == 'super admin' || strtolower(Auth::user()->role->name) == 'admin gudang folding gate')
                            {
                            ?>
                                <li class="pushy-link"><a href="{{ route('good_receipt_folding_gate') }}">Folding Gate</a></li>
                            <?php
                            }
                            if(strtolower(Auth::user()->role->name) == 'super admin' || strtolower(Auth::user()->role->name) == 'admin gudang rolling door')
                            {
                            ?>
                                <li class="pushy-link"><a href="{{ route('good_receipt_rolling_door') }}">Rolling Door</a></li>
                            <?php
                            }
                            ?> 
                        </ul>
                    </li>
                    <?php
                    }
                    if(strtolower(Auth::user()->role->name) == 'super admin' || strtolower(Auth::user()->role->name) == 'admin gudang folding gate' || strtolower(Auth::user()->role->name) == 'admin gudang rolling door')
                            {
                    ?>
                    <li class="pushy-submenu">
                        <button id="first-link">Pengeluaran Barang</button>
                        <ul>
                            <?php
                            if(strtolower(Auth::user()->role->name) == 'super admin' || strtolower(Auth::user()->role->name) == 'admin gudang folding gate')
                            {
                            ?>
                                <li class="pushy-link"><a href="{{ route('good_usage_folding_gate') }}">Folding Gate</a></li>
                            <?php
                            }
                            if(strtolower(Auth::user()->role->name) == 'super admin' || strtolower(Auth::user()->role->name) == 'admin gudang rolling door')
                            {
                            ?>
                                <li class="pushy-link"><a href="{{ route('good_usage_rolling_door') }}">Rolling Door</a></li>
                            <?php
                            }
                            ?> 
                        </ul>
                    </li>
                    <?php
                    }
                    ?>
                   <!--  <li class="pushy-submenu">
                        <button>Create Order</button>
                        <ul>
                            <li class="pushy-link"><a href="#">Folding Gate</a></li>
                            <li class="pushy-link"><a href="#">Folding Gate Spare Part</a></li>
                            <li class="pushy-link"><a href="#">Rolling Door</a></li>
                            <li class="pushy-link"><a href="#">Rolling Door Spare Part</a></li>
                        </ul>
                    </li> -->
                    <li class="pushy-submenu">
                        <button id="second-link">Akun</button>
                        <ul>
                            <?php
                            if(strtolower(Auth::user()->role->name) == 'super admin')
                            {
                            ?>
                            <li class="pushy-link"><a href="{{ route('account') }}">Kelola Akun</a></li>
                            <?php
                            }
                            ?>
                            <li class="pushy-link"><a href="{{ route('change_password') }}">Ganti Password</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Keluar
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="pushy-link"><a href="#">Item 3</a></li> -->
                    <
                </ul>
            </div>
        </nav>

        <!-- Site Overlay -->
        <div class="site-overlay"></div>

        <!-- Your Content -->
        <div id="container">
            <!-- Menu Button -->
            <button class="menu-btn">&#9776; Menu</button>
            @yield('content')
            

        </div>

        <footer class="site-footer push">&copy; <?php echo date('Y') ?></footer>

        <!-- Pushy JS -->
        <script src="{{ asset('js/pushy.min.js') }}"></script>

    </body>
</html>