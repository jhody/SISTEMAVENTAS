<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/icon.ico') }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS Core -->


    <script src="{{ asset('pace/pace.js') }}"></script>
        <link href="{{ asset('pace/themes/black/pace-theme-corner-indicator.css') }}" rel="stylesheet">

    <script src="{{ asset('jQuery/jQuery-2.1.4.min.js') }}"></script>

    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>




      <link href="{{ asset('adminlte/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminlte/css/skins/_all-skins.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminlte/css/ionicons.min.css') }}" rel="stylesheet">

      <link href="{{ asset('fontawesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">


    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet">
      <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.ui-smoothness.css') }}" rel="stylesheet">

      <!-- JavaScript Files -->
      <script src="{{ asset('ComponenteJQ/jqwidgets/jqxcore.js') }}"></script>
      <script src="{{ asset('ComponenteJQ/jqwidgets/jqxdata.js') }}"></script>
      <script src="{{ asset('ComponenteJQ/jqwidgets/jqxwindow.js') }}"></script>

      <!-- JavaScript Files -->
        <script src="{{ asset('js/menu.js?') }}"></script>


    <link href="{{ asset('perfect_scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <script src="{{ asset('perfect_scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>


    <link href="{{ asset('perfect_scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <script src="{{ asset('perfect_scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>

    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet">
    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.arctic.css') }}" rel="stylesheet">
    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.ui-smoothness.css') }}" rel="stylesheet">
    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.ui-redmond.css') }}" rel="stylesheet">

    <!-- JavaScript Files -->
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxcore.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxdata.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxgrid.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxgrid.selection.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxgrid.filter.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxgrid.sort.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxgrid.edit.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxdropdownlist.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxscrollbar.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxbuttons.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxgrid.aggregates.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxpanel.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/globalization/globalize.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxgrid.pager.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxgrid.columnsresize.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxlistbox.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxwindow.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxinput.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxkanban.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxsortable.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxswitchbutton.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxcheckbox.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxtooltip.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxnotification.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxtree.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxtabs.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxcombobox.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxradiobutton.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxnumberinput.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxvalidator.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxprogressbar.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxpasswordinput.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxdatetimeinput.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxcalendar.js') }}"></script>

    <link href="{{ asset('AmaranJS/dist/css/amaran.min.css') }}" rel="stylesheet">



    <!-- DataTables -->
    <script src="{{ asset('datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatables/dataTables.select.min.js') }}"></script>

    <!-- SweetAlert -->
    <script src="{{ asset('sweetalert/dist/sweetalert.min.js') }}"></script>
    <link href="{{ asset('sweetalert/dist/sweetalert.css') }}" rel="stylesheet">

    <!-- Datepicker -->
    <script src="{{ asset('datepicker/datepicker/bootstrap-datepicker.js') }}"></script>
    <!--<link href="{{ asset('datepicker/datepicker/datepicker.css') }}" rel="stylesheet">-->

    <!-- Input Mask -->
    <script src="{{ asset('input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('input-mask/jquery.inputmask.extensions.js') }}"></script>

    <!-- Typeahead -->
    <script src="{{ asset('typehead/typeahead.bundle.js') }}"></script>

    <!-- jQuery -->
    <script src="{{ asset('jQuery/jQuery-2.1.4.min.js') }}"></script>

    <!-- Bootstrap Select -->
    <script src="{{ asset('selectboots/bootstrap-select.min.js') }}"></script>
    <link href="{{ asset('selectboots/bootstrap-select.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">

    <script>
        var urlproject = "{{ url('/') }}";
        var urlusuario = "{ route('usuario.index') }";
        var urlindex = "{{ route('site.index') }}";

        paceOptions = {
            elements: false,
            restartOnPushState: false,
            restartOnRequestAfter: false
        }


        $(document).ready(function () {

            Pace.on('done', function() {
                $("#pagecontent").css("display","inline");
            });


            fn_aceptar_solo_numeros7();
            fn_aceptar_solo_decimals7();
            // Más inicializaciones...
        });

        function fn_aceptar_solo_numeros7(){
        $(".allow_numero").unbind('keypress');
        $(".allow_numero").keypress(function(e) {
            var key = window.Event ? e.which : e.keyCode
            return (key >= 48 && key <= 57)
            });
        }
        function fn_aceptar_solo_decimals7(){
        $(".allow_decimal").unbind('keypress');
        $('.allow_decimal').keypress(function (evt) {
            var element=this;
                    var charCode = (evt.which) ? evt.which : event.keyCode

                if (
                    (charCode != 45 || $(element).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
                    (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
                    (charCode < 48 || charCode > 57))
                    return false;

                return true;
                });
        }
    </script>

    <style>
        .required{
            color:red;
            font-size:14px;
        }
        .modal-backdrop{
            opacity:0.5;
        }
        .pace {
            -webkit-pointer-events: none;
            pointer-events: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .pace .pace-progress {
            background: #29d;
            position: fixed;
            z-index: 2000;
            top: 0;
            right: 100%;
            width: 100%;
            height: 2px;
        }

        .amaran-wrapper { z-index: 99999; }

        .dt-center { text-align: center; }
        .dt-right { text-align: right; }

        table.dataTable tbody>tr.selected,
        table.dataTable tbody>tr>.selected {
            background-color: #b9dff6;
        }
        .modal-content .overlay{
            display: none;align-items:center;justify-content:center;position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;z-index: 50;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 3px;
        }
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 80%;
            color: #fd397a;
        }
        .form-control.is-invalid ~ .invalid-feedback{
            display:block;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini" id="pagecontent" style="display:none;">
    <div class="wrapper">
        <!-- Header -->
        <header class="main-header">
            <a href="{{ route('site.index') }}" class="logo">
                <span class="logo-mini"><b>S</b>EE</span>
                <span class="logo-lg"><b>Ventas S</b>istema</span>
            </a>

            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="btnmenuuser">
                                <img src="{{ Auth::user()->avatar_url ?? asset('images/avatar1.png') }}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{ Auth::user()->nombre ?? 'Usuario' }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="{{ Auth::user()->avatar_url ?? asset('images/avatar1.png') }}" class="img-circle" alt="User Image">
                                    <p>
                                        {{ Auth::user()->nombre ?? 'Usuario' }}
                                        <small>{{ Auth::user()->rol ?? '' }}</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left" style="display:none;">
                                        <a href="{ route('usuario.perfil') }" class="btn btn-default btn-flat">
                                            <i class="fa fa-user"></i> Ver Perfil
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="btn btn-default btn-flat">
                                                Cerrar Sesión <i class="fa fa-sign-out"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Sidebar -->
        <aside class="main-sidebar">
            <section class="sidebar">

                <ul class="sidebar-menu">

                    <li class="header" style="display:flex;align-items:center;justify-content:center;">
                        <img width="70%" src="{{ asset('images/logo2.png') }}?" border="0">
                    </li>
                    <li class="header">MENÚ DE NAVEGACIÓN</li>
                    <li class="menu_inicio">
                        <a href="{{ route('site.index') }}" id="reloj345jyhody"><i class="fa fa-home"></i><span> Inicio</span></a>
                    </li>
                    <li class="menu_ventas">
                        <a href="{{ route('venta.index') }}" id=""><i class="fa fa-file-text-o"></i><span> Ventas</span></a>
                    </li>
                    <li class="menu_compras">
                        <a href="{{ route('compra.index') }}" id=""><i class="fa fa-file-text-o"></i><span> Compras</span></a>
                    </li>
                    @if (Auth::check() && Auth::user()->perfil == 'administrador')
                    <li class="menu_categorias">
                        <a href="{{ route('categoria.index') }}" id=""><i class="fa fa-tags"></i><span> Categorias</span></a>
                    </li>
                    @endif
                    <li class="menu_clientes">
                        <a href="{{ route('cliente.index') }}" id=""><i class="fa fa-users"></i><span> Clientes</span></a>
                    </li>
                    @if (Auth::check() && Auth::user()->perfil == 'administrador')
                    <li class="menu_productos">
                        <a href="{{ route('producto.index') }}" id=""><i class="fa fa-cubes"></i><span> Productos</span></a>
                    </li>
                    <li class="menu_mediospago">
                        <a href="{{ route('mediopago.index') }}" id=""><i class="fa fa-tags"></i><span> Medio de pago</span></a>
                    </li>
                    <li class="menu_usuarios">
                        <a href="{{ route('usuario.index') }}" id=""><i class="fa fa-users"></i><span> Usuarios</span></a>
                    </li>
                    @endif
                </ul>
            </section>
        </aside>

        <!-- Content -->
        <div class="content-wrapper">
            <section class="content" id="idcontenido">
                @yield('content')
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Versión</b> 1.0.0
            </div>
            <strong>Copyright © {{ date('Y') }}</strong> Desarrollado.
        </footer>
    </div>

    <!-- Modales -->
    <div id="popupmsjAlerta">
        <div>Aviso</div>
        <div style="overflow: hidden;">
            <div class="row">
                <div class="col-sm-12">
                    <div style='display:inline;' id="mostrarmsjj"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="notif_general">
        <div id="msjnotif_general"></div>
    </div>

    <div id="popup_general_errores_detallados">
        <div>Error de operación</div>
        <div style="overflow: hidden;">
            <div class="row">
                <div class="col-sm-12">
                    <div style='display:inline;' id="msjnotif_general_errores_detallados"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="popupProgresoValidacion">
        <div></div>
        <div>
            <div id='horizontalProgressBar'></div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>


    <script src="{{ asset('AmaranJS/dist/js/jquery.amaran.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

    <script src="{{ asset('chartjs/Chart.min.js') }}"></script>

    <!-- Scripts adicionales -->
    @stack('scripts')
</body>
</html>
