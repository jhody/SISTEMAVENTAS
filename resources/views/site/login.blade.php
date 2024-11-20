<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/icon.ico') }}" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap/css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminlte/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminlte/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('iCheck/square/blue.css') }}" rel="stylesheet">

    <!-- jqwidgets CSS -->
    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.base.css') }}" rel="stylesheet">
    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.ui-redmond.css') }}" rel="stylesheet">
    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.ui-smoothness.css') }}" rel="stylesheet">
    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.darkblue.css') }}" rel="stylesheet">
    <link href="{{ asset('ComponenteJQ/jqwidgets/styles/jqx.orange.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
    <form id="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="login-box">
            <div class="login-logo">
                <b style="color:#3b85a8;">Iniciar Sesión</b>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">
                    <img width="50%" src="{{ asset('images/logo.png') }}" border="0">
                </p>

                <div class="form-group has-feedback">
                    <input type="text" name="LoginForm[username]" id="LoginForm_username" class="form-control" placeholder="Usuario" value="{{ old('username') }}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <div class="errorMessage" id="LoginForm_username_em_" style="display:none"></div>
                    @error('username')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group has-feedback">
                    <input type="password" name="LoginForm[password]" id="LoginForm_password" class="form-control" placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <div class="errorMessage" id="LoginForm_password_em_" style="display:none"></div>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div id="cargando" style="display:none;">
                            <img src="{{ asset('images/cargador.gif') }}"/>Validando datos...
                        </div>
                        <div id="mensaje" class="error"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck" style="padding-left: 0px;">
                            <label>
                                <input type="checkbox" name="remember"> Recordarme
                            </label>
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="button" class="btn btn-primary btn-block btn-flat" id="jqxbtnLogin">
                            <img src="{{ asset('images/clientNew.png') }}"/> Ingresar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="popupmsjAlerta">
            <div id="titleaviso">Aviso</div>
            <div style="overflow: hidden;">
                <div class="row">
                    <div class="col-sm-12">
                        <div style='display:inline;' id="mostrarmsjj"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Scripts -->
    <script src="{{ asset('jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxcore.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxdata.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxbuttons.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxvalidator.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxinput.js') }}"></script>
    <script src="{{ asset('ComponenteJQ/jqwidgets/jqxwindow.js') }}"></script>

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#popupmsjAlerta").jqxWindow({
                theme: 'ui-smoothness',
                closeAnimationDuration: 600,
                showCloseButton: false,
                width: 300,
                height: 100,
                resizable: false,
                isModal: true,
                autoOpen: false,
                cancelButton: $("#btnsalirMsj"),
                modalOpacity: 0.5
            });

            $( "#LoginForm_password" ).keypress(function( event ) {
                $("#LoginForm_password_em_").css("display","none");
                if ( event.which == 13 ) {
                    fn_login();
                }
            });

            $("#LoginForm_username").keypress(function() {
                $("#LoginForm_username_em_").css("display","none");
            });

            $("#jqxbtnLogin").on('click', function () {
                fn_login();
            });
            $('#LoginForm_username').focus();
        });

        function fn_redireccionar(){
            $('#popupmsjAlerta').jqxWindow('close');
            $(location).attr('href', "{{ route('site.index') }}");
        }
        function fn_validar_ctrls(){
        $("label").find("i").remove();
            $("label").css("color", "#000000" );
            var valorretorno=true;

            if($("#LoginForm_username").val().trim()==""){
                $("#LoginForm_username_em_").css("display","");
                $("#LoginForm_username_em_").html("Ingresar un usuario");
                //$("#LoginForm_password").parent().parent().find("label").css("color", "red" );
                valorretorno= false;
            }
            if($("#LoginForm_password").val().trim()==""){
                $("#LoginForm_password_em_").css("display","");
                $("#LoginForm_password_em_").html("Ingresar el password");
                //$("#LoginForm_password").parent().parent().find("label").css("color", "red" );
                valorretorno= false;
            }
            if(!valorretorno){
            $("#idmsjerror234").css("display","inline");
            }else{

            $("#idmsjerror234").css("display","none");
            }
            return valorretorno;
        }
        function fn_login() {
            if(fn_validar_ctrls()) {
                $("#mensaje").html('');
                var formData = new FormData(document.getElementById('login-form'));

                $.ajax({
                    url: "{{ route('ingresar') }}",
                    dataType: 'json',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $("#cargando").css("display", "inline");
                        $("#jqxbtnLogin").attr("disabled", "disabled");
                    },
                    success: function(arreglo) {
                        $("#jqxbtnLogin").removeAttr("disabled");
                        $("#cargando").css("display", "none");
                        if(arreglo.error=="0"){
                            $("#titleaviso").html("Mensaje de Bienvenida");
                            $("#popupmsjAlerta").jqxWindow({  width: 300,height:100});
                            fn_iniciarPoputmsj("ico_bienvenida.png",arreglo.msj,"#LoginForm_username","fn_redireccionar()","Continuar");
                            $("#btnsalirMsj").css("display","none");
                            $("#btncontinuar").focus();
                        }else{
                            $('#yw0_button').attr("class","btn btn-primary");
                            $('#yw0_button').attr("style","margin-left:8px");
                            $("#yw0_button").click();
                            var mssjj=arreglo.msj;

                            if(arreglo.capcha){
                            $("#idmostrarsesioncapcha").css("display","inline");
                            mssjj=arreglo.info;
                            }else{
                            $("#idmostrarsesioncapcha").css("display","none");
                            }
                            $("#titleaviso").html("Credenciales incorrectas");
                            $("#popupmsjAlerta").jqxWindow({  width: 300,height:100});
                            fn_iniciarPoputmsj("ico_Error.gif",arreglo.msj,"#LoginForm_username","$('#popupmsjAlerta').jqxWindow('close');$('#LoginForm_password').focus();","Aceptar");
                            $("#btnsalirMsj").css("display","none");
                            $("#btncontinuar").focus();
                        }

                    },
                    error: function(xhr) {
                        $("#jqxbtnLogin").removeAttr("disabled");
                        $("#titleaviso").html("Ocurrio un Error");
                        $("#cargando").css("display", "none");
                        //swal("Ocurrió un error!", "Ocurrio un error al conectar con el servidor!", "error" );
                        $("#popupmsjAlerta").jqxWindow({  width: 300,height:100});
                        if(xhr.responseJSON!=null){
                            fn_iniciarPoputmsj("ico_Error.gif",xhr.responseJSON.msj,"#LoginForm_username","$('#popupmsjAlerta').jqxWindow('close');$('#jqxbtnLogin').focus();","Aceptar");
                        }else{

                            fn_iniciarPoputmsj("ico_Error.gif","Ocurrio un error al conectar con el servidor!","#LoginForm_username","$('#popupmsjAlerta').jqxWindow('close');$('#jqxbtnLogin').focus();","Aceptar");
                        }
                        $("#btnsalirMsj").css("display","none");
                        $("#btncontinuar").focus();
                    }
                });
            }
        }

        function fn_iniciarPoputmsj(imagen,msj,control,funcion,btnok){
            msj =  '<div class="col-md-2">'+
                    `<img width="40px" src="{{ asset('images/ico_bienvenida.png') }}" border="0">`+
                    '</div>'+
                    '<div class="col-md-10">'+
                    '<div class="row">'+
                        '<div class="col-md-12"> '+msj+
                        '</div>'+
                    '</div>'+
                    '<div class="row" style="padding-top:5px;">'+
                        '<div class="col-md-12">'+
                        '<button type="button" id="btncontinuar" onclick="'+funcion+'" class="btn btn-xs btn-default">'+
                            '<span class="glyphicon glyphicon-check"></span> '+btnok+
                        '</button>'+
                        '<button type="button" id="btnsalirMsj"  class="btn btn-xs btn-default">'+
                            '<span class="glyphicon glyphicon-share"></span>Cancelar'+
                        '</button>'+
                        '</div>'+
                    '</div>'+
                    '</div>' ;
                $("#mostrarmsjj").html(msj);
                var offset = $(control).offset();
                $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj") } );
                $("#popupmsjAlerta").jqxWindow('open');
        }
    </script>

    <style type="text/css">
        .alert-success { color: #000 !important; }
        .form-control-feedback {
            position: absolute !important;
            top: 0 !important;
            right: 0 !important;
            z-index: 2 !important;
            display: block !important;
            width: 34px !important;
            height: 34px !important;
            line-height: 34px !important;
            text-align: center !important;
            pointer-events: none !important;
        }
        .errorMessage { color: red; }
        .login-page, .register-page { background: #c7e2ea !important; }
        .in {
            display: flex !important;
            justify-content: center;
            flex-direction: column;
        }
        body {
            background: #F2F2F2;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
            align-items: center;
            height: 100%;
        }
    </style>
</body>
</html>
