
 function fn_resetear_clave(id){
    $("#error_claveactual").css("display", "none");
    $("#error_claveactual").html(""); 
    var rowindex = $('#jqxgrid_usuario').jqxGrid('getselectedrowindex'); 
    var data1 = $('#jqxgrid_usuario').jqxGrid('getrowdata', rowindex);

    $("#error_claveactual").css("display", "none");
    $("#txtclavenueva").val(""); 
    $("#txtclavenueva2").val("");
    $("#popup_cambiar_clave").jqxWindow('open'); 
    $("#popup_cambiar_clave").find(".dasddw5titlereset").html("Resetear clave-"+data1.n_username);
    $("#txtclaveactual").focus();
 }
 function fn_cancelar_cambio_clave(){
        $("#popup_cambiar_clave").jqxWindow('close'); 
    }
    function fn_actualizar_clave(){
        var check = $('#form-actualizar-clave').jqxValidator('validate');
        if(!check){
            return;
        }
        var rowindex = $('#jqxgrid_usuario').jqxGrid('getselectedrowindex'); 
        var data1 = $('#jqxgrid_usuario').jqxGrid('getrowdata', rowindex);
        var url1 = urlusuario+"/Actualizarclave";  
        $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  {
                claveactual: $("#txtclaveactual").val(),
                clavenueva: $("#txtclavenueva").val(),
                clavenueva2: $("#txtclavenueva2").val(),
                c_iduser: data1.c_iduser
            } ,  
            beforeSend: function() {   
                $("#cargando_actualizar_clave").css("display", "inline");
                $("#btnactualizar_clave").attr("disabled","disabled") ;
                $("#btncancelar_cambio_clave").attr("disabled","disabled") ;
                $("#error_claveactual").css("display", "none");
              },
            success: function(arreglo){  
                $("#btnactualizar_clave").removeAttr("disabled"); 
                $("#btncancelar_cambio_clave").removeAttr("disabled");   
                $("#cargando_actualizar_clave").css("display", "none"); 
                if(arreglo.error=="0"){ 
                    fn_notificacion_general("success","Aviso","Clave actualizada","",""); 
                    $("#popup_cambiar_clave").jqxWindow("close"); 
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,"",arreglo.info); 
                } 
                if(arreglo.error=="2"){//clave actual incorrecta
                    $("#error_claveactual").html(arreglo.msj);
                    $("#error_claveactual").css("display", "inline");
                }
                if(arreglo.error=="3"){//datos de formulario vacio

                }
                if(arreglo.error=="4"){//claves no coinciden

                }
            },
            error: function(xhr){   
                fn_cerrar_ventana_msjs_menu();
                $("#cargando_actualizar_clave").css("display", "none");  
                $("#btnactualizar_clave").removeAttr("disabled") ; 
                $("#btncancelar_cambio_clave").removeAttr("disabled") ;   
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
      });
    }
 function CargarGrilla_usuarios(){
    //alert(url); 
    $("#jqxgrid_usuario").jqxGrid('clearselection'); 
    $("#chkselroles").jqxCheckBox({ checked: false });
    $("#jqxgrid_roles").jqxGrid(
    { 
        source: null,  
    }); 
    var url1 = urlusuario+"/BuscarClientes";
    var source =
    {
        datatype: "json",
        datafields: [
            {name:'c_iduser',type: 'string' },
            {name:'n_username',type: 'string' },   
            {name:'c_estado',type: 'string' }, 
            {name:'i_intentos',type: 'string' }, 
            {name:'c_idpersonal',type: 'string' }, 
            {name:'n_usuario',type: 'string' },  
            {name:'d_fechamodificacion',type: 'string'}, 
            {name:'personal',type: 'string'},  
            {name:'id_clave',type: 'string'},  
            {name:'c_dni',type: 'string'},  
            {name:'n_traba_nombre1',type: 'string'},  
            {name:'c_traba_sexo',type: 'string'},  
            {name:'n_latitud',type: 'string'},  
            {name:'n_longitud',type: 'string'},  
            {name:'n_traba_direccion',type: 'string'},  
            {name:'n_traba_email',type: 'string'},  
            {name:'c_estciv_id',type: 'string'},  
            {name:'n_usuario',type: 'string'},  
            {name:'d_fechamodificacion',type: 'string'},
            {name:'ip',type: 'string'},
            {name:'ipap',type: 'string'},
            {name:'estado',type: 'string'},
            {name:'telefono',type: 'string'},
            {name:'movil',type: 'string'},
            {name:'mac',type: 'string'},
            {name:'instalado',type: 'string'}, 
            {name:'codigo',type: 'string'},
            {name:'plan',type: 'string'},
            {name:'monto',type: 'string'},
            {name:'pasarela',type: 'string'},
            {name:'hotspot_user',type: 'string'},
            {name:'hotspot_pass',type: 'string'},
            {name:'hotspot_server',type: 'string'}, 
            {name:'thundercache',type: 'string'},
            {name:'i_idservidor',type: 'string'},
            {name:'emisor',type: 'string'},
            {name:'user_ubnt',type: 'string'},
            {name:'pass_ubnt',type: 'string'},
            {name:'nodo',type: 'string'},
            {name:'status',type: 'string'},
            {name:'tiene_foto',type: 'string' }  
        ], 
        data: {
            'cadena': $("#textoBusqueda").val() 
        },
        type:'POST',
        id: 'c_iduser',
        url: url1,
        root: 'data'
    }; 
     
    $("#jqxgrid_usuario").jqxGrid(
    { 
        source: source,  
    });      
} 
 function CargarGrilla_roles(id){
    //alert(url); 
    var rowindex = $('#jqxgrid_usuario').jqxGrid('getselectedrowindex'); 
    $("#chkselroles").jqxCheckBox({ checked: false });
    $("#jqxgrid_roles").jqxGrid(
    { 
        source: null,  
    }); 
    if(rowindex!=-1){
        var data1 = $('#jqxgrid_usuario').jqxGrid('getrowdata', rowindex);

        
        var url1 = urlusuario+"/ListarRoles";
        var source =
        {
            datatype: "json",
            datafields: [
                {name: 'sel',type: 'bool' },
                {name:'c_rol',type: 'string' },
                {name:'n_nombre',type: 'string' },  
                {name:'n_descripcion',type: 'string' } 
            ], 
            data: {
                'c_iduser': id
            },
            type:'POST',
            id: 'c_rol',
            url: url1,
            root: 'data'
        }; 
         
        $("#jqxgrid_roles").jqxGrid(
        { 
            source: source,  
        });     
    }
         
} 
function fn_nuevo(){
    $("label").find("i").remove();
    $("label").css("color", "#000000" );

    $("#btngenerarid").css("display","inline");
    $("#esNuevo").val("1");
    $("#titulo_poput_mantenedor").html('<span class="glyphicon glyphicon-tasks"></span> Registrar Nuevo Cliente');
    $("#popup_mantenedor").jqxWindow('open');
    $("#Usuario_c_idpersonal1").val("");

    $("#ClienteDatos_i_idservidor").val(-1);
    $("#Usuario_c_idpersonal").val(-1);  
    $('#Usuario_c_idpersonal').selectpicker('val', [1]); 
    $('#ClienteDatos_plan').html("");
    $('#ClienteDatos_plan').selectpicker('refresh');
    //$('select[name=Usuario[c_idpersonal]]').val(-1);
    //$('select[name=Usuario[c_idpersonal]]').selectpicker('refresh');
    //$('#Usuario_c_idpersonal').selectpicker('refresh')
    $("#Personas_c_dni").val("");   
    $("#Personas_n_traba_nombre1").val(""); 
    $("#Personas_n_traba_email").val(""); 
    $("#Usuario_n_username").val(""); 
    $("#Usuario_n_password").val(""); 
    $("#Personas_n_traba_direccion").val(""); 
    $("#Personas_coordenadas").val(""); 
    $("#Usuario_c_iduser").val("");
    $("#Usuario_c_estado").val("1");
    $("#ClienteDatos_movil").val(""); 
    $("#ClienteDatos_telefono").val(""); 
    $("#ClienteDatos_monto").val(""); 
    $("#ClienteDatos_ip").val(""); 
    $("#ClienteDatos_mac").val(""); 
    $("#ClienteDatos_codigo").val(""); 
    $("#ClienteDatos_pasarela").val(""); 
    $("#ClienteDatos_ipap").val(""); 
    $("#ClienteDatos_user_ubnt").val(""); 
    $("#ClienteDatos_pass_ubnt").val(""); 
    $("#ClienteDatos_user_ubnt").val("");  

    $("#file-preview").attr("src",ulrproj+"/images/avatar1.png"); 

    fn_generarid();
    $("#idesvisibleclaveform").css("display","inline");
    $("#idmsjerror234").css("display","none");
    fn_buscarpersona1($("#idbuscarpers3445"));
    $("#idbuscarpers3445").css("display","none");
    $("#idnuevapers3445").css("display","inline");

    $("label").find("i").remove();
    $("label").css("color", "#000000" );
    $("#idmsjerror234").css("display","none");
}
function fn_generarid(){
    var url1 = urlusuario+"/Generar_id";
    $.ajax({
                type: "POST",
                url:  url1,
                cache:false,
                    contentType: false,
                    processData: false,
                beforeSend: function() {   
                    $("#Usuario_c_iduser").val("");
                    $("#cargando_generar_id").css("display", "inline");
                  },
                success: function(nuevoid){  
                    $("#cargando_generar_id").css("display", "none"); 
                    $("#Usuario_c_iduser").val(nuevoid);
                },
                error: function(xhr){
                  $("#cargando_generar_id").css("display", "none");
                    
                }
          });
}
function fn_cancelar(){

    $("#popup_mantenedor").jqxWindow('close'); 
}
function fn_nuevo_rol_asignado(){

    $("#chk_seleccion_roles").jqxCheckBox({ checked: false });
    var rowindex = $('#jqxgrid_usuario').jqxGrid('getselectedrowindex');  

      if(rowindex!=-1){
          
            var data = $('#jqxgrid_roles').jqxGrid('getrowdata', rowindex); 
            $("#popup_asignacion_rol").jqxWindow('open'); 
            //cargar grilla de roles
            fn_cargar_seleccion_roles(urlrol);
      }else{ 
            fn_mostrar_msj("ico_alerta.jpg","Seleccione un Usuario para asignarle roles","#jqxgrid_roles",'fn_cerrar_poput_msjs()',"Aceptar");
            var offset = $("#jqxgrid_roles").offset();  
            $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
            position: { x: parseInt(offset.left) + 30, y: parseInt(offset.top) + 280 }} ); 
          $("#btncancelarMsj").css("display","none");
            $("#btnaceptarMsj").focus();
      } 
}
function fn_quitar_rol_usuario(c_iduser){
        //iniciando barra de progreso

        var contador_Seleccionados=0;
        var url1 = urlusuario+"/quitarRol";
        var rows = $('#jqxgrid_roles').jqxGrid('getrows');
        var selectedItems = new Array();
        for(i=0;i<rows.length;i++)
        { 
            var data = $('#jqxgrid_roles').jqxGrid('getrowdata', i); 
            if(data.sel){ 
              contador_Seleccionados = contador_Seleccionados + 1;
            }
        }

        var offset = $("#jqxgrid_roles").offset();
        $("#popupProgresoValidacion").jqxWindow({ position: { x: parseInt(offset.left) + 30, y: parseInt(offset.top) +100}});
        $("#popupProgresoValidacion").jqxWindow('open'); 
        $('#horizontalProgressBar').jqxProgressBar({  value: 0});
        var tempp=0;
        var valorProgressBarUnit = 100/contador_Seleccionados;
        var contt=0; 
        for(i=0;i<rows.length;i++){
            var data = $('#jqxgrid_roles').jqxGrid('getrowdata', i);
            if(data.sel){
                id_rolsel = data.c_rol;
                $.ajax({
                        type: "POST",
                        url:    url1,
                        dataType: 'json',
                        data:  {
                                    c_rol:id_rolsel,
                                    c_iduser:c_iduser
                                },
                        beforeSend: function() {     
                        },
                        success: function(arreglo){ 
                            contt=contt+1;
                            tempp=valorProgressBarUnit*contt;
                            $('#horizontalProgressBar').jqxProgressBar({  value: tempp});
                            error = arreglo.error; 
                            if(error=="1"){
                                selectedItems.push(arreglo.c_rol+' '+arreglo.n_nombre+' ERROR:'+arreglo.info);
                            }
                            if(contt>=contador_Seleccionados)
                            {
                                fn_cerrar_poput_msjs();
                                $("#chkselroles").jqxCheckBox({ checked: false });
                                $("#popupProgresoValidacion").jqxWindow('close'); 
                                $('#horizontalProgressBar').jqxProgressBar({  value: 0});

                                var rowindex1 = $('#jqxgrid_usuario').jqxGrid('getselectedrowindex'); 
                                var data2 = $('#jqxgrid_usuario').jqxGrid('getrowdata', rowindex1);

                                CargarGrilla_roles(data2.c_iduser);
                                if(selectedItems.length>0)
                                {
                                    fn_mostrar_msj("ico_alerta.jpg","No se pudo quitar algunos roles","#jqxgrid_roles","fn_MostrarInconsistencias()","Ver errores");
                                    $("#btncancelarMsj").css("display","inline"); 
                                    var offset = $("#jqxgrid_roles").offset();  
                                    $("#popupmsjAlerta").jqxWindow({position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 160 }} ); 
                                }else{
                                    $("#popup_asignacion_rol").jqxWindow('close');
                                    fn_notificacion_general("success","Aviso","¡Se quitaron los roles!","","");
                                }
                            }
                        },
                        error: function(xhr){fn_cerrar_poput_msjs();
                            $("#popupProgresoValidacion").jqxWindow('close'); 
                            $('#horizontalProgressBar').jqxProgressBar({  value: 0});
                            fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
                    }
                });
            }
        }
}
function fn_eliminar_rol_asignado(){
    var url1 = urlusuario+"/quitarRol";
    var rowindex = $('#jqxgrid_usuario').jqxGrid('getselectedrowindex'); 
    var data1 = $('#jqxgrid_usuario').jqxGrid('getrowdata', rowindex);

    var contador_Seleccionados=0;
    var rows = $('#jqxgrid_roles').jqxGrid('getrows');
    var selectedItems = new Array();
    for(i=0;i<rows.length;i++)
    { 
        var data = $('#jqxgrid_roles').jqxGrid('getrowdata', i); 
        if(data.sel){ 
          contador_Seleccionados = contador_Seleccionados + 1;
        }
    }
    if(contador_Seleccionados>0){
        var data = $('#jqxgrid_roles').jqxGrid('getrowdata', rowindex); 
          $("#popupmsjAlerta").jqxWindow({  width: 300,height:110});
          fn_mostrar_msj("ico_pregunta.jpg","¿Desea quitar los roles asignados al usuario "+data1.personal+"?","#jqxgrid_roles","fn_quitar_rol_usuario('"+data1.c_iduser+"')","Continuar");
          var offset = $("#jqxgrid_roles").offset();  
        $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
          position: { x: parseInt(offset.left) + 30, y: parseInt(offset.top) + 290 }} ); 

          $("#btnsalirMsj").css("display","inline");
          $("#btnaceptarmsj").focus(); 
    }else{
        fn_mostrar_msj("ico_alerta.jpg","Aún no ha seleccionado un Rol","#jqxgridseleccionarRol","$('#popupmsjAlerta').jqxWindow('close')","Aceptar");
            $("#btncancelarMsj").css("display","none"); 
            var offset = $("#jqxgrid_roles").offset(); 
            $("#popupmsjAlerta").jqxWindow({theme: "ui-smoothness",
            position: { x: parseInt(offset.left) + 30, y: parseInt(offset.top) + 280 }} ); 
    }
}
function fn_validar_nombre_usuario(){
    $("#Usuario_n_username").closest('div').find("label").find("i").remove();
    $("#Usuario_n_username").closest('div').find("label").css("color", "#000000" );
    
    var url1 = urlusuario+"/validar_nombre_usuario";
    if($("#Usuario_n_username").val().trim()==""){  
        $("#Usuario_n_username").closest('div').find("label").append(' <i rel="tooltip" data-animate="animated fadeIn" data-toggle="tooltip" data-original-title="No ha ingresado un nombre de usuario" class="fa fa-exclamation-circle"></i>');
        $("#Usuario_n_username").closest('div').find("label").css("color", "red" );
        return;
    }

    var idpers="";
    if($("#esNuevo").val()=="1"){
      
    }else{
      idpers=$('#Usuario_c_iduser').val(); 
    }
    if(idpers){

    }else{
      idpers="";
    }

    var url1 = urlusuario+"/validar_nombre_usuario";
    $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  {
                n_username:$("#Usuario_n_username").val(),
                c_iduser:idpers
            } ,  
            beforeSend: function() {   
                $("#imgvalidate_cargando_username").css("display", "inline"); 
                $("#Usuario_n_username").attr("disabled","disabled") ; 
              },
            success: function(arreglo){  
                $("#Usuario_n_username").removeAttr("disabled");    
                $("#imgvalidate_cargando_username").css("display", "none"); 
                if(arreglo.error=="0"){ 
                    $("#Usuario_n_username").closest('div').find("label").append(' <i rel="tooltip" data-animate="animated fadeIn" data-toggle="tooltip" data-original-title="username es válido" class="fa fa-exclamation-circle"></i>');
                    $("#Usuario_n_username").closest('div').find("label").css("color", "green" );
                }
                if(arreglo.error=="1"){
                    //fn_notificacion_general("error","Aviso",arreglo.msj,"",arreglo.info); 
                    $("#Usuario_n_username").closest('div').find("label").append(' <i rel="tooltip" data-animate="animated fadeIn" data-toggle="tooltip" data-original-title="Ya existe otro usuario con el mismo username" class="fa fa-exclamation-circle"></i>');
                    $("#Usuario_n_username").closest('div').find("label").css("color", "red" );
                } 
            },
            error: function(xhr){   
                fn_cerrar_ventana_msjs_menu();
                $("#imgvalidate_cargando_username").css("display", "none");  
                $("#Usuario_n_username").removeAttr("disabled") ;  
                $("#Usuario_n_username").closest('div').find("label").append(' <i rel="tooltip" data-animate="animated fadeIn" data-toggle="tooltip" data-original-title="Ya existe otra persona con el mismo DNI" class="fa fa-exclamation-circle"></i>');
                $("#Usuario_n_username").closest('div').find("label").css("color", "red" );
                //fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
        });
}


function fn_eliminar(){
    var rowindex = $('#jqxgrid_usuario').jqxGrid('getselectedrowindex');  

      if(rowindex!=-1){
          
            var data = $('#jqxgrid_usuario').jqxGrid('getrowdata', rowindex); 
          $("#popupmsjAlerta").jqxWindow({  width: 300,height:110});
          fn_mostrar_msj("ico_pregunta.jpg","¿Desea eliminar al usuario "+data.personal+"?","#jqxgrid_usuario","fn_eliminar_usuario('"+data.c_iduser+"')","Continuar");
          var offset = $("#jqxgrid_usuario").offset();  
        $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
          position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 

          $("#btnsalirMsj").css("display","inline");
          $("#btnaceptarmsj").focus();
      }else{ 
            fn_mostrar_msj("ico_alerta.jpg","Seleccione una fila de la tabla para eliminar","#jqxgrid_usuario",'fn_cerrar_poput_msjs()',"Aceptar");
            var offset = $("#jqxgrid_usuario").offset();  
            $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
            position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 
          $("#btncancelarMsj").css("display","none");
            $("#btnaceptarMsj").focus();
      } 
}
function fn_eliminar_usuario(id){
    fn_cerrar_ventana_msjs_menu();
    var url1 = urlusuario+"/Eliminar";
        $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  {c_iduser:id} ,  
            beforeSend: function() {   
                $("#cargandousuario11").css("display", "inline");
                $("#btnnuevo").attr("disabled","disabled") ;
                $("#btneditar").attr("disabled","disabled") ;
                $("#btneliminar").attr("disabled","disabled") ;
              },
            success: function(arreglo){  
                $("#btnnuevo").removeAttr("disabled"); 
                $("#btncancelar_rol").removeAttr("disabled");  
                $("#btneditar").removeAttr("disabled") ;
                $("#btneliminar").removeAttr("disabled") ; 
                $("#msjnotifrol").html(arreglo.msj);
                $("#cargandousuario11").css("display", "none"); 
                if(arreglo.error=="0"){
                    CargarGrilla_usuarios();
                    fn_notificacion_general("success","Aviso","Usuario eliminado","","");
                    CargarGrilla_roles();
                    $("#popup_mantenedor").jqxWindow('close'); 
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                } 
            },
            error: function(xhr){   
                $("#btnnuevo").removeAttr("disabled"); 
                $("#btneditar").removeAttr("disabled") ;
                $("#btneliminar").removeAttr("disabled") ; 
                $("#cargandousuario11").css("display", "none"); 
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
      });
}
 