@extends('layouts.app')

@section('content')<!-- jQuery -->
<style>
ul.wysihtml5-toolbar>li {
    float: left;
    display: list-item;
    list-style: none;
    margin: 0 0 10px 0;
}
.dropdown, .dropup {
    position: relative;
}
.icheckbox_flat-green, .iradio_flat-green {
    display: inline-block;
    vertical-align: middle;
    margin: 0;
    padding: 0;
    width: 20px;
    height: 20px;
    background: url("{{ asset('images/green.png') }}") no-repeat;
    border: none;
    cursor: pointer;
}
.icheckbox_flat-green.checked {
    background-position: -22px 0;
}
.datepicker{z-index:1151 !important;}
</style>

<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h4><i class="fa fa-tags"></i> Medios de Pago</h4>
                <p class="pull-right" id="cargandoareas" style="display:none;">
                    <img align="absmiddle" style="display:inline;" src="{{ asset('images/cargador.gif') }}"/>  Procesando...
                </p>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 actionBar">
                        <div class="input-group" style="margin-bottom:10px;">
                            <div class="btn-group" role="group" aria-label="...">
                                <div class="btn-group" style="margin-right:10px;">
                                    <div class="input-group" style="display:inline">
                                        <button type="button" class="btn btn-primary command-new-router" onclick="fn_nuevo()">
                                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Nuevo
                                        </button>
                                    </div>
                                </div>
                                <div class="input-group" style="width:45%;">
                                    <input type="text" class="form-control" id="textoBusqueda" placeholder="Buscar" aria-describedby="basic-addon2">
                                    <span class="input-group-addon" id="basic-addon2" style="cursor:pointer;" onclick="CargarGrilla();">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="btn-group" role="group" aria-label="..." style="margin-left:10px;">
                                <select class="form-control" onchange="CargarGrilla();" name="form_estado" id="form_estado">
                                    <option value="TT">TODOS</option>
                                    <option value="1">ACTIVO</option>
                                    <option value="0">INACTIVO</option>
                                </select>
                        </div>
                        </div>
                    </div>
                </div>

                <table class="table table-striped- table-bordered table-hover table-checkable" id="idtabla_listado" style="margin-top:10px;width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>estado</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="overlay" id="idboxgeneral" style="display:none;">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<a style="display:none;" id="idbtnpopup_mantenedor" data-toggle="modal" data-target="#popup_mantenedor"></a>
<div class="modal " id="popup_mantenedor" style="z-index:9999;" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content" id="form_psasadsfd23423">
            <div class="modal-header" style="padding:3px;">
                <div id="titulo_poput_mantenedor_emisor" class="modal-title jqx-window-header jqx-window-header-ui-smoothness jqx-widget-header jqx-widget-header-ui-smoothness jqx-disableselect jqx-disableselect-ui-smoothness jqx-rc-t jqx-rc-t-ui-smoothness" style="position: relative;width: 100%;cursor: move;">
                    <span class="fa fa-home"></span> Nuevo Local
                </div>
            </div>
            <div class="modal-body">
                @include('mediopago._form', ['model' => $model])
            </div>
            <div class="modal-footer" style="border-top: 1px solid #D8D8D8;background-color:#F2F2F2;border-radius: 0 0 4px 4px;">
                <div id="idmsjerror234" class="pull-left" style="color: red;display:none">
                    No se puede guardar, Verifique los campos marcados con <i class="fa fa-exclamation-circle"></i>
                </div>
                <div class="pull-left">
                    <p class="text-info" id="cargando" style="display:none;">
                        <img align="absmiddle" style="display:inline;" src="{{ asset('images/cargador.gif') }}"/>  Guardando...
                    </p>
                </div>
                <button type="button" id="btncancelar" class="btn btn-default closex" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btnguardar" onclick="fn_guardar()" class="btn btn-primary submitxemi">Registrar</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script type="text/javascript">
    var urlarea = "{{ route('mediopago.index') }}";
    var ulrproj = "{{ url('/') }}";
    var listado = [];
    var tabla;

    $(document).ready(function (){
        $(".menu_mediospago").addClass("active");
        $(".menu_mediospago a").append(`<span style="color:yellow;" class=" pull-right"><i class="fa fa-check" aria-hidden="true"></i></span>`);
        $('#popup_mantenedor').on('shown.bs.modal', function() {
            $("#titulo_poput_mantenedor_emisor").css("width",$('#form_psasadsfd23423').width()-19);
        });

        renderizartabla([]);

        CargarGrilla();

        $("#textoBusqueda").keypress(function(event) {
            if (event.which == 13) {
                CargarGrilla();
            }
        });

    });

    function renderizartabla(lista){

        //$("#idtabla_listado").html();
        $(".chktabestado").change(function() {
            fn_cambiar_estado_registro($(this).attr("idreg"));
            if(this.checked) {
                //Do stuff
            }
        });

        $("#idtabla_listado_filter").css("display","none");
        $("#idtabla_listado_length").css("display","none");
        $("#textoBusqueda").keyup(function(event) {

        });
    }

    function CargarGrilla(){
        $.ajax({
            type: "POST",
            url: "{{ route('mediopago.buscar') }}",
            dataType: 'json',
            data: {
                cadena: $("#textoBusqueda").val(),
                listartodo: true,
                start: 0,
                cant: 10,
                estado: $("#form_estado").val(),
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $("#cargandomenus").css("display", "inline");
            },
            success: function(arreglo){
                $("#msjnotifrol").html(arreglo.msj);
                $("#cargandomenus").css("display", "none");
                listado = arreglo.lista;
                var tmp = [];
                $("#idtabla_listado tbody").html(``);
                for(var p in arreglo.lista){
                    $("#idtabla_listado tbody").append(`
                        <tr>
                            <td>${arreglo.lista[p]["id"]}</td>
                            <td>${arreglo.lista[p]["nombre"]}</td>
                            <td>${(arreglo.lista[p]["estado"]=="1")?`
                                <span class="label label-success">ACTIVO</span>
                            `:`
                                <span class="label label-default">INACTIVO</span>
                            `}</td>
                            <td>
                                <div style="text-align: center; margin-top: 5px;">
                                    <button type="button" style="color:green" onclick="fn_editar(${arreglo.lista[p]["id"]});" class="btn btn-default btn-sm" data-row-id="1" data-toggle="tooltip" data-placement="bottom" data-original-title="Editar chofer">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                    <button type="button" class="btn btn-default btn-sm" style="color:red" onclick="fn_confirmar_eliminar(${arreglo.lista[p]["id"]});" data-row-id="1" data-toggle="tooltip" data-placement="top" title="Eliminar chofer">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `);
                }
                renderizartabla(tmp);
            },
            error: function(xhr){
                fn_notificacion_general("error", "Error en servidor", "Ocurrio un error al cargar lista", "fa fa-window-close", "click aqui para ver detalle", xhr.responseText);
            }
        });
    }

    function fn_nuevo(){
        $("label").find("i").remove();
        $("label").css("color", "#000000");
        $("#titulo_poput_mantenedor_emisor").html('<span class="fa fa-file"></span> Nuevo medio de pago');

        $("#carro-form").find('input').val("");
        $("#esNuevo").val("1");
        $("#idmsjerror234").css("display","none");
        $("#popup_mantenedor").modal("toggle");
        $("#btnguardar").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Registrar');
    }

    function fn_guardar(){
        if(fn_validar_ctrls()){
            var token = $('meta[name="csrf-token"]').attr('content');
            var url1 = "{{ route('mediopago.store') }}";
            var msjjj = "Medio de pago registrado";
            let tipo='POST';
            var formData = new FormData(document.forms.namedItem("carro-form"));
            if($("#esNuevo").val()!="1"){
                url1 = "{{ route('mediopago.update', ':id') }}".replace(':id', $("#Registro_id").val());
                msjjj = "Medio de pago actualizado";
                tipo='PUT';
            }
            formData.delete('_token');
            formData.append('_token', '{{ csrf_token() }}');


            var ajaxConfig = {
                method: tipo,
                type: tipo,
                data:{},
                url: url1,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': token // Incluir el token CSRF en el encabezado
                },
                beforeSend: function() {
                    $("#idboxgeneral").css("display", "");
                    $("#btnguardar").attr("disabled","disabled");
                    $("#btncancelar").attr("disabled","disabled");
                },
                success: function(arreglo){
                    $("#btnguardar").removeAttr("disabled");
                    $("#btncancelar").removeAttr("disabled");
                    $("#idboxgeneral").css("display", "none");
                    if(arreglo.error=="0"){
                        fn_notificacion_general("success","Aviso",msjjj,"","");
                        if($("#popup_mantenedor").is(":visible")){
                            $("#popup_mantenedor").modal('toggle');
                        }
                        CargarGrilla();

                    }
                    if(arreglo.error=="1"){
                        fn_notificacion_general("error","Aviso",arreglo.msj,"",arreglo.info);
                    }
                },
                error: function(xhr){
                    $("#idboxgeneral").css("display", "none");
                    $("#btnguardar").removeAttr("disabled");
                    $("#btncancelar").removeAttr("disabled");
                    let msj_tmp='';
                    if(xhr.responseText!=null){
                        msj_tmp=JSON.parse(xhr.responseText);
                        msj_tmp=msj_tmp.msj;
                    }
                    fn_notificacion_general("error","Aviso",msj_tmp,"click aqui para ver detalle",xhr.responseText);
                }
            };
            if (ajaxConfig.method === 'POST') {
                ajaxConfig.cache = false;
                ajaxConfig.contentType = false;
                ajaxConfig.processData = false;
                ajaxConfig.data=formData;
            }
            if (ajaxConfig.method === 'PUT'){

                formData.forEach(function(value, key) {
                    ajaxConfig.data[key] = value;
                });
            }
            $.ajax(ajaxConfig);
        }
    }

    function fn_validar_ctrls(){
        $("label").find("i").remove();
        $("label").css("color", "#000000");
        var valorretorno = true;

        if($("#nombre").val().trim()==""){
            $("#nombre").parent().parent().find("label").append(' <i rel="tooltip" data-animate="animated fadeIn" data-toggle="tooltip" data-original-title="Ingrese un nombre" class="fa fa-exclamation-circle"></i>');
            $("#nombre").parent().parent().find("label").css("color", "red");
            valorretorno = false;
        }

        $("input").keypress(function() {
            $(this).closest('div').find("label").find("i").remove();
            $(this).closest('div').find("label").css("color", "#000000");
        });

        if(!valorretorno){
            $("#idmsjerror234").css("display","inline");
        }else{
            $("#idmsjerror234").css("display","none");
        }
        return valorretorno;
    }

    function fn_confirmar_eliminar(id){
        var item = [];
        for(var prop in listado){
            if(listado[prop]["id"]==id){
                item = listado[prop];
                break;
            }
        }
        if(item.length==0)
            return;

        swal({
            title: "Eliminando Registro",
            text: "Desea eliminar el medio de pago "+item["nombre"]+"?",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, Eliminar!",
            closeOnConfirm: true,
            showLoaderOnConfirm: true,
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('mediopago.destroy', ':id') }}".replace(':id', item["id"]),
                    dataType: 'json',
                    data: {
                        id: item["id"],
                        _token: '{{ csrf_token() }}'
                    },
                    beforeSend: function() {
                        $("#idboxgeneral").css("display", "block");
                    },
                    success: function(arreglo){
                        $("#idboxgeneral").css("display", "none");
                        if(arreglo.error=="0"){
                            fn_notificacion_general("success","Aviso",arreglo.msj,"","");
                            CargarGrilla();
                        }
                        if(arreglo.error=="1"){
                            fn_notificacion_general("error","Aviso",arreglo.msj,"",arreglo.info);
                        }
                    },
                    error: function(xhr){
                        $("#idboxgeneral").css("display", "none");
                        swal("Ocurrio un error!","No se pudo eliminar!","error");
                    }
                });
            }else{
                fn_notificacion_general("error","Aviso","Operación cancelada","","");
            }
        });
    }

    function fn_editar(id){
        var data = null;
        for(var prop in listado){
            if(listado[prop]["id"]==id){
                data = listado[prop];
                break;
            }
        }
        if(data==null)
            return;

        $("label").find("i").remove();
        $("label").css("color", "#000000");
        $("#idmsjerror234").css("display","none");
        $("#btnguardar").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar');

        $("#esNuevo").val("2");
        $("#titulo_poput_mantenedor_emisor").html('<span class="glyphicon glyphicon-tasks"></span> Editar medio de pago');

        $("#carro-form").find('input').val("");
        $("#Registro_id").val(data.id);
        $("#nombre").val(data.nombre || '');
        $("#estado").val(data.estado || '');

        $("#idbtnpopup_mantenedor").click();
    }

    function fn_cambiar_estado(ctrl,id){
        $.ajax({
            type: "POST",
            url: "route('mediopago.cambiar-estado') }}",
            dataType: 'json',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            beforeSend: function() {
                $("#idboxgeneral").css("display", "inline");
            },
            success: function(arreglo){
                $("#idboxgeneral").css("display", "none");
                if(arreglo.error=="0"){
                    fn_notificacion_general("success","Aviso",arreglo.msj,"","");
                    CargarGrilla();
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,"",arreglo.info);
                }
            },
            error: function(xhr){
                $("#idboxgeneral").css("display", "none");
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
        });
    }

</script>
@endpush
