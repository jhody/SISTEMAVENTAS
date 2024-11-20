<form id="compra-form" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="esNuevo" value="1">
    <input type="hidden" name="id" id="Registro_id" value="{{ old('id', $producto->id ?? '') }}">
    <input name="idcliente" id="Compra_idcliente" type="hidden" value="">
    <input name="detalle" id="Compra_detalle" type="hidden" value="">

    <div class="row ibox-content">
        <!-- Sección Fecha -->
        <div class="form-group input-group-sm col-md-2">
            <label style="color: rgb(0, 0, 0);">Fecha</label>
            <span class="fa fa-clock-o" aria-hidden="true" id="txt_hora" style="cursor:pointer;display:inline;margin-top:-20px;">13:7:5</span>


            <div id="D_Liquida_Fecha_tmp" data-role="input" role="textbox" style="width: 120px; height: 30px;"
                aria-owns="calendarjqxWidgetb7fa6ff4" aria-haspopup="true" aria-readonly="false"
                class="jqx-widget jqx-datetimeinput jqx-input jqx-overflow-hidden jqx-rc-all jqx-reset jqx-clear jqx-widget-content"
                aria-valuenow="Fri Nov 15 2024 00:00:00 GMT-0500 (hora estándar de Perú)"
                aria-valuetext="15/11/2024"
                aria-valuemin="Mon Jan 01 1900 00:00:00 GMT-0508 (hora estándar de Perú)"
                aria-valuemax="Fri Jan 01 2100 00:00:00 GMT-0500 (hora estándar de Perú)"
                aria-disabled="false"
                aria-label="Current focused date is 15/11/2024, 12:00:00 a.m.">
                <div class="jqx-max-size jqx-position-relative">
                    <input class="dateyhody jqx-position-absolute jqx-reset jqx-clear jqx-input-content jqx-widget-content jqx-rc-all"
                           id="Compra_fecha"
                           autocomplete="off"
                           name="fecha"
                           type="textarea"
                           style="width: 100px; left: 0px; top: 0px; margin-top: 7px; text-align: left;">
                    <div style="height: 100%; width: 19px; left: 101px;"
                         class="jqx-position-absolute jqx-action-button jqx-fill-state-normal jqx-rc-r">
                        <div class="jqx-icon jqx-icon-calendar"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group input-group-sm col-md-4">
            <label style="color: rgb(0, 0, 0);">Comprobante
                <span class="required" style="font-size:15px;">*</span>
            </label>


            <select style="width:100%;" placeholder="" class="form-control" name="tipodoc" id="Compra_tipodoc">
                    <option value="1">FACTURA</option>
                    <option value="2">BOLETA</option>
            </select>
        </div>

        <!-- Sección Moneda -->

        <!-- Sección Tipo operación -->

        <!-- Sección Serie y Número -->
        <div class="form-group input-group-sm col-md-2">
            <label style="color: rgb(0, 0, 0);">Serie
                <span class="required" style="font-size:15px;">*</span>
            </label>
            <input size="3" maxlength="3" class="form-control allow_numero"
                   name="serie" id="Compra_serie" type="text">
        </div>

        <div class="form-group input-group-sm col-md-2">
            <label style="color: rgb(0, 0, 0);">Número
                <span class="required" style="font-size:15px;">*</span>
            </label>
            <input size="20" maxlength="20" class="form-control allow_numero"
                   name="numero" id="Compra_numero" type="text">
        </div>

        <!-- Sección Datos del Cliente -->
        <div class="col-md-12">
            <div class="box box-solid" style="box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12)">
                <div class="box-header with-border">
                    <h3 class="box-title pull-left">
                        <i class="fa fa-user"></i> Datos del cliente
                    </h3>&nbsp;&nbsp;
                    <code style="font-weight:normal;font-size:12px;">
                        del comprobante de compra
                    </code>
                </div>

                <div class="box-body">
                    <div class="form-group input-group-sm col-md-3" style="">
                        <input type="text" maxlength="11" class="form-control allow_numero" id="txt_nrodoc_sel_form" placeholder="Nº documento" aria-describedby="basic-addon2">
                        <span class="required" style="position:absolute;right:20px;top:3px;font-size:24px;">*</span>
                    </div>
                    <div class="form-group input-group-sm col-md-7" style="position:relative;">
                        <input type="text" class="form-control" id="txt_nombre_sel_form" name="cliente_nombre" placeholder="Buscar cliente" aria-describedby="basic-addon2" autocomplete="off">
                        <span class="required" style="position:absolute;right:20px;top:3px;font-size:24px;">*</span>
                    </div>
                    <div class="form-group input-group-sm col-md-2" style=" ">
                    <input type="number" class="form-control" id="Cliente_telefono" name="cliente_contacto" placeholder="N° celular" aria-describedby="basic-addon2">
                    </div>
                    <div class="form-group input-group-sm col-md-8">
                    <input type="text" class="form-control" id="Cliente_direccion" name="cliente_direccion" placeholder="Dirección" aria-describedby="basic-addon2">
                    </div>

                    <div class="form-group input-group-sm col-md-4">
                        <input class="form-control" placeholder="Email" name="cliente_correo" id="Cliente_email" type="text">
                    </div>
                </div>

                <div class="overlay" id="idloadsearchcli" style="display:none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
            </div>
        </div>


        <!-- Sección de Búsqueda de Productos -->
        <div class="form-group input-group-sm col-md-6">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-search"></i>
                </span>
                <input id="idbuscarprod_cod54568" autocomplete="off" type="text"
                       class="form-control"
                       placeholder="Buscar producto...">
            </div>
            <p class="text-info" id="cargandodetallformyhody" style="display:none;">
                <img align="absmiddle" style="display:inline;" src="/images/cargador.gif">
                Actualizando Detalle...
            </p>
        </div>

        <!-- Sección de Botones de Acción -->
        <div class="form-group input-group-sm col-md-4">
            <div class="">
                <button type="button" id="btnquitartodo"
                        onclick="fn_quitar_form_prod_todo()"
                        class="btn btn-warning submitxemi btn-sm"
                        style="display: inline;">
                    <i class="fa fa-times" aria-hidden="true"></i> Quitar todo
                </button>
            </div>
        </div>
        <!-- Sección de Tabla de Productos -->
        <div class="form-group col-md-12">
            <div class="panel panel-default" style="margin-bottom: 0px;">
                <!-- Cabecera de la tabla -->
                <div class="" style="">
                    <table width="100%" id="idtabla_productos" class="table">
                        <thead style="background-image: linear-gradient(to bottom, #f5f5f5 0, #e8e8e8 100%);">
                            <tr id="idcabformdoc">
                                <td style="width: 50px;vertical-align: text-top;text-align:center;">
                                    Id
                                </td>
                                <td>
                                    Producto
                                </td>
                                <td style="width: 60px;vertical-align: text-top;text-align:center;">
                                    Und/Med
                                </td>
                                <td style="width: 120px;vertical-align: text-top;text-align:center;">
                                    Precio
                                </td>
                                <td style="width: 120px;vertical-align: text-top;text-align:center;">
                                    Cantidad
                                </td>
                                <td style="width: 70px;vertical-align: text-top;text-align:center;">
                                    SubTotal
                                </td>
                                <td style="width: 40px;vertical-align: text-top;text-align:center;">
                                    <button type="button" style="color: #0d46e6;"
                                            onclick="fn_verinfocalc(this)" class="">
                                        <i class="fa fa-info"></i>
                                    </button>
                                </td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <!-- Cuerpo de la tabla -->
                <div class="panel-body" style="padding:0px">
                    <table width="100%" style="border-collapse: separate;border-spacing: 10px 5px;">
                        <tbody id="idtab_form_list_items_factura"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección de Observaciones -->
        <div class="form-group input-group-sm col-md-8">
            <label style="color: rgb(0, 0, 0);">Observaciones</label>
            <textarea style="width:100%;height:130px;"
                      placeholder=""
                      class="form-control"
                      name="observaciones"
                      id="Compra_observaciones"></textarea>

                        <!-- Sección de Notas -->

        </div>

        <!-- Sección de Totales -->
        <div class="form-group input-group-sm col-md-4">
            <table width="100%" style="border-collapse: separate;">
                <tbody>
                    <tr>
                        <td>Total</td>
                        <td class="form-group input-group-sm">
                            <input type="text" class="form-control inputresumyh allow_decimal"
                                   name="total"
                                   id="Compra_total" readonly="">
                        </td>
                    </tr>
                </tbody>
            </table>

            <div style="margin-top:20px;">
                <label style="color: rgb(0, 0, 0);">Medio de Pago</label>
                <select style="width:100%;" placeholder="" name="idmediopago" id="Compra_idmediopago" class="form-control">
                    @foreach ($mediospago as $unidad)
                        <option value="{{ $unidad->id }}"
                            {{ old('idunidad_medida', $producto->idunidad_medida ?? '') == $unidad->id ? 'selected' : '' }}>
                            {{ $unidad->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</form>

<style>
    .sectubigeo {
        padding: 5px;
        border-radius: 5px;
        border: 1px solid #bfd1fa;
    }
    .sectubigeo>.tit_yh {
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        background: #eaeaea;
        padding: 3px 5px;
        margin-bottom: 5px;
    }
    .jqx-widget-header-ui-smoothness {
        background: white;
        border-color: #aaa;
        color: #222222;
        font-size: 12px;
        border: 1px solid #aaa;
        font-weight: bold;
        font-size: 11px;
        moz-border-radius: 4px;
        border-radius: 4px;
    }
    .jqx-window-header {
        outline: none;
        border-width: 0px;
        border-bottom: 1px solid transparent;
        overflow: hidden;
        padding: 5px;
        height: auto;
        white-space: nowrap;
        overflow: hidden;
    }
    #idtabla_productos tbody>tr>td:nth-child(1),
    #idtabla_productos tbody>tr>td:nth-child(3)
    {
        text-align:center;
    }
    #idtabla_productos tbody>tr>td:nth-child(4)>input,
    #idtabla_productos tbody>tr>td:nth-child(5)>input{
        text-align:center;
    }
    #idtabla_productos tbody>tr>td:nth-child(6){
        font-weight:bold;
        text-align:right;
    }
</style>
<div id="popupmsjsearch_cliente" style="display:none;box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);z-index:999999;position:absolute;" class="jqx-window-header jqx-widget-header jqx-disableselect jqx-rc-t jqx-window-header-ui-smoothness jqx-widget-header-ui-smoothness jqx-disableselect-ui-smoothness jqx-rc-t-ui-smoothness">
      <div style="background: #cccccc;padding: 5px 10px;">Seleccionar Cliente:</div>
      <div style="">

            <table class="table table-striped- table-bordered table-hover table-checkable" id="idtabla_clientes" style="margin-top:10px;width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>RUC</th>
                            <th>nombre</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
            </table>
        <div style="position:absolute;margin-top:-7px;margin-left:770px;z-index: 2;box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12)">
          <button style="color:red;" type="button" onclick="$('#jqxgrid_searchcli_gen5345_cliente').jqxGrid({source: null});$('#popupmsjsearch_cliente').jqxWindow('close'); " class="btn btn-xs btn-default command-edit"  ><span class="glyphicon glyphicon-remove-sign"></span></button>

        </div>
          <div class="row">
            <div class="col-sm-12" id="id_cargagrillasearchclientgen_cliente" style="z-index: 1;">
              <div id="jqxgrid_searchcli_gen5345_cliente"></div>

            </div>
          </div>
      </div>
</div>



<div id="popupmsjsearch_producto" style="display:none;box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);z-index:999999;position:absolute;" class="jqx-window-header jqx-widget-header jqx-disableselect jqx-rc-t jqx-window-header-ui-smoothness jqx-widget-header-ui-smoothness jqx-disableselect-ui-smoothness jqx-rc-t-ui-smoothness">
      <div style="background: #cccccc;padding: 5px 10px;">Seleccionar Producto:</div>
      <div style="">

            <table class="table table-striped- table-bordered table-hover table-checkable" id="idtabla_productosearch" style="margin-top:10px;width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Unidad</th>
                            <th>Precio S/</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
            </table>
      </div>
</div>
<script>

    let lista_clientes=[];
    $(document).ready(function() {
        $(".dateyhody").datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'dd/mm/yyyy'
        }).on('changeDate', function(ev){
            $(this).datepicker('hide');
            pagina=0;
        });

      $("#txt_nombre_sel_form").click(function( event ) {
        $(this).val("");
        $("#Compra_idcliente").val("");
        if($("#idtabla_clientes tbody").html().trim()!=""){
            $("#popupmsjsearch_cliente").css('display',"");
        }
      });
      $("#txt_nombre_sel_form").keypress(function( event ) {
            const $input = $(this);
            const $popup = $("#popupmsjsearch_cliente");
            const inputPosition = $input[0].getBoundingClientRect();
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

            $popup.css({
                'position': 'fixed',
                'width': $input.outerWidth() + 'px',
                'left': inputPosition.left + scrollLeft,
                'top': inputPosition.bottom + 5, // 5px de espacio
                'z-index': 1000
            });

          if($("#txt_nombre_sel_form").val().trim()==""){

          }else{
            $("#popupmsjsearch_cliente").css('display',"");
            $("#popupmsjsearch_cliente").css('z-index',"99999");

            $.ajax({
                type: "POST",
                url: "{{ route('cliente.buscar') }}",
                dataType: 'json',
                data: {
                    cadena: $("#textoBusqueda").val(),
                    listartodo: true,
                    start: 0,
                    cant: 10,
                    estado: 1,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    $("#cargandomenus").css("display", "inline");
                },
                success: function(arreglo){
                    $("#msjnotifrol").html(arreglo.msj);
                    $("#cargandomenus").css("display", "none");
                    //listado = arreglo.lista;
                    var tmp = [];
                    lista_clientes=arreglo.lista;
                    $("#idtabla_clientes tbody").html(``);
                    for(var p in arreglo.lista){
                        $("#idtabla_clientes tbody").append(`
                            <tr idreg="${arreglo.lista[p]["id"]}">
                                <td>${arreglo.lista[p]["id"]}</td>
                                <td>${arreglo.lista[p]["ruc"]}</td>
                                <td>${arreglo.lista[p]["razonsocial"]}</td>
                            </tr>
                        `);
                    }
                    $("#idtabla_clientes tbody>tr").mousedown(function(){
                        let idreg= $(this).attr("idreg");
                        for(var p in lista_clientes){
                            if(lista_clientes[p]["id"]==idreg){
                                $("#Compra_idcliente").val($(this).find(">td:nth-child(1)").html());
                                $("#txt_nrodoc_sel_form").val(lista_clientes[p]["ruc"]);
                                $("#txt_nombre_sel_form").val(lista_clientes[p]["razonsocial"]);
                                $("#Cliente_telefono").val(lista_clientes[p]["contacto"]);
                                $("#Cliente_direccion").val(lista_clientes[p]["domicilio"]);
                                $("#Cliente_email").val(lista_clientes[p]["correo"]);
                                break;
                            }
                        }
                    })

                },
                error: function(xhr){
                    fn_notificacion_general("error", "Error en servidor", "Ocurrio un error al cargar lista", "fa fa-window-close", "click aqui para ver detalle", xhr.responseText);
                }
            });
          }
      })
        .blur(function() {
            // Pequeño timeout para permitir clicks en el popup
            setTimeout(() => {
                $("#popupmsjsearch_cliente").hide();
            }, 200);
        });
        //para buscar productos

      $("#idbuscarprod_cod54568").click(function( event ) {
        $(this).val("");

        if($("#idtabla_productosearch tbody").html().trim()!=""){
            $("#popupmsjsearch_producto").css('display',"");
        }
      });
      $("#idbuscarprod_cod54568").keypress(function( event ) {
            const $input = $(this);
            const $popup = $("#popupmsjsearch_producto");
            const inputPosition = $input[0].getBoundingClientRect();
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

            $popup.css({
                'position': 'fixed',
                'width': $input.outerWidth() + 'px',
                'left': inputPosition.left + scrollLeft,
                'top': inputPosition.bottom + 5, // 5px de espacio
                'z-index': 1000
            });

          if($("#idbuscarprod_cod54568").val().trim()==""){

          }else{
            $("#popupmsjsearch_producto").css('display',"");
            $("#popupmsjsearch_producto").css('z-index',"99999");

            $.ajax({
                type: "POST",
                url: "{{ route('producto.buscar') }}",
                dataType: 'json',
                data: {
                    cadena: $("#idbuscarprod_cod54568").val(),
                    listartodo: true,
                    start: 0,
                    cant: 10,
                    estado: 1,
                    _token: '{{ csrf_token() }}'
                },
                beforeSend: function() {
                    $("#cargandomenus").css("display", "inline");
                },
                success: function(arreglo){
                    $("#msjnotifrol").html(arreglo.msj);
                    $("#cargandomenus").css("display", "none");
                    lista_productos_search = arreglo.lista;
                    var tmp = [];
                    $("#idtabla_productosearch tbody").html(``);
                    for(var p in arreglo.lista){
                        $("#idtabla_productosearch tbody").append(`
                            <tr>
                                <td>${arreglo.lista[p]["id"]}</td>
                                <td>${arreglo.lista[p]["nombre"]}</td>
                                <td>${arreglo.lista[p]["unidad_medida"]}</td>
                                <td>${arreglo.lista[p]["precio_compra"]}</td>
                            </tr>
                        `);
                    }
                    $("#idtabla_productosearch tbody>tr").mousedown(function(){
                        $("#idbuscarprod_cod54568").val("");
                        var idp=$(this).find(">td:nth-child(1)").html();
                        for(var p in lista_productos_search){
                            if(lista_productos_search[p]["id"]==idp){
                                $("#idtabla_productos").find("tbody").append(`
                                    <tr class="itemprecform">
                                        <td>${$(this).find(">td:nth-child(1)").html()}</td>
                                        <td>${lista_productos_search[p]["nombre"]}</td>
                                        <td>${lista_productos_search[p]["unidad_medida"]}</td>
                                        <td class="form-group input-group-sm"><input style="width:100%;text-align:center;" class="form-control calcdetform allow_decimal" type="number" value="${lista_productos_search[p]["precio_compra"]}"></td>
                                        <td class="form-group input-group-sm"><input style="width:100%;text-align:center;" class="form-control calcdetform allow_decimal" type="number" value="1"></td>
                                        <td class="form-group input-group-sm">${parseFloat(lista_productos_search[p]["precio_compra"]).toFixed(2)}</td>
                                        <td>
                                            <button type="button" style="color:red" onclick="fn_quitar_item_form_factura(this)" class="btn btn-icon btn-sm btn-default" ><i class="glyphicon glyphicon-trash"></i></button>
                                        </td>
                                    </tr>
                                `);
                                break;
                            }
                        }
                        $("#idtabla_productos").find("input").unbind("change");
                        $("#idtabla_productos").find("input").change(function( event ) {
                            fn_calcular_totales_form();
                        });
                        fn_calcular_totales_form();
                    })

                },
                error: function(xhr){
                    fn_notificacion_general("error", "Error en servidor", "Ocurrio un error al cargar lista", "fa fa-window-close", "click aqui para ver detalle", xhr.responseText);
                }
            });
          }
      })
        .blur(function() {
            // Pequeño timeout para permitir clicks en el popup
            setTimeout(() => {
                $("#popupmsjsearch_producto").hide();
            }, 200);
        });;
    });
let lista_productos_search=[];
function fn_quitar_form_prod_todo(){
    $("#idtabla_productos tbody").html("");
    fn_calcular_totales_form();
}
function fn_quitar_item_form_factura(ctrl){
    $(ctrl).closest("tr").remove();
    fn_calcular_totales_form();
}
function fn_calcular_totales_form(){
    //calcular de todas las filas, los precios
  var fixednumber=parseInt(2);
  var desctotal=0;
  var total=0;
  /*if($("#OrdenCompra_descuento_global_porcentaje").val().trim()!=""){
      porcdscto=$("#OrdenCompra_descuento_global_porcentaje").val();
  }
  if($("#OrdenCompra_otros_cargos").val().trim()!=""){
      otroscargos=$("#OrdenCompra_otros_cargos").val();
  }*/
    $(".itemprecform").each(function(){
        var precio=0;

        precio=$(this).find("td:nth-child(4)").find("input").val().trim();

        var cantidad=$(this).find("td:nth-child(5)").find("input").val().trim();


        if(precio==""){
            precio="0";
        }
        if(cantidad==""){
            cantidad="0";
        }

          var subtotal=0;
          var totalitem=0;
            subtotal= precio*cantidad;
            totalitem=subtotal;
            total+=totalitem;

        $(this).find("td:nth-child(6)").html(totalitem.toFixed(2));
    });

    $('#Compra_total').val(parseFloat(total).toFixed(fixednumber));
}
</script>
