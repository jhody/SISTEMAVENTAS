function iniciarGrillas(){ 
	var source =
    {
      datatype: "json",
        datafields: [
            {name:'c_rol',type: 'string' },
            {name:'n_nombre',type: 'string' },  
            {name:'n_descripcion',type: 'string' } 
        ],  
        type:'POST',
        id: 'c_rol', 
        root: 'data'
    }; 
    var renderer = function (row, column, value) {
        return '<span style="margin-left: 4px; margin-top: 4px; float: left;">' + value + '</span>';
    }
    // creage jqxgrid
    $("#jqxgrid_roles").jqxGrid(
    {
        width: '99%',
        height: 440,
        theme: "ui-smoothness",
        source: source,  
        columnsresize: true, 
        columns: [ 
			{ text: 'Código',	 	datafield: 'c_rol',	editable: false,hidden:false , width: '10%', cellsrenderer: renderer },
			{ text: 'Nombre',	datafield: 'n_nombre',	editable: false,hidden:false , width: '40%', cellsrenderer: renderer },  
			{ text: 'Descripción',	 	datafield: 'n_descripcion',	editable: false,hidden:false , width: '50%', cellsrenderer: renderer },   
          ]
    });
	$("#jqxgrid_roles").on('rowselect', function (event) { 
        var data = $('#jqxgrid_roles').jqxGrid('getrowdata', event.args.rowindex);
        ver_accesos(data.c_rol); 
        //$("#btnnuevo").attr("disabled","disabled") ;
        $("#btnnuevo").removeAttr("disabled") ;
        $("#btneditar").removeAttr("disabled") ;
        $("#btneliminar").removeAttr("disabled") ; 
    }); 
 }
 function CargarGrilla_roles(){
    //alert(url);
    $('#jqxTree_menues').jqxTree('uncheckAll');
    var url1 = urlrol+"/Buscar";
    var source =
    {
        datatype: "json",
        datafields: [
            {name:'c_rol',type: 'string' },
            {name:'n_nombre',type: 'string' },  
            {name:'n_descripcion',type: 'string' } 
        ], 
        data: {
            'cadena': $("#textoBusqueda").val() 
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
function ver_accesos(id){  
    var url1 = urlmenuesacciones+"/listarMenusArbol"; 
    $.ajax({
                type: "POST",
                url:  url1,
                dataType: 'json',
                //
                data:  {c_rol:id},   
                beforeSend: function() {   
                    $("#cargandomenus").css("display", "inline");
                    
                    $('#jqxTree_menues').jqxTree('uncheckAll');

                  },
                success: function(arreglo){  
                    $("#cargandomenus").css("display", "none");

                    jQuery.each(arreglo, function(i, val) { 
                        $("#jqxTree_menues").jqxTree('checkItem', $("#"+val)[0], true);;
                    });
                },
                error: function(xhr){
                    $("#cargandomenus").css("display", "none");
 
                }
          });
}
function cargar_treeviewmenus(){
    var url1 = urlmenuesacciones+"/cargar_arbol_menus"; 
    $.ajax({
                type: "POST",
                url:  url1, 
                // 
                beforeSend: function() {   
                    $("#cargandomenus").css("display", "inline"); 

                  },
                success: function(contenido){  
                    $("#cargandomenus").css("display", "none");
                    $("#arbolmenus").html(contenido);
                     
                },
                error: function(xhr){
                    $("#cargandomenus").css("display", "none");
 
                }
          });
}
function fn_nuevo(){
        $("#btngenerarid").css("display","inline");
    $("#esNuevo").val("1");
    $("#titulo_poput_mantenedor").html("Nuevo Rol");
    $("#popup_mantenedor").jqxWindow('open'); 
    $("#Roles_n_nombre").focus();
    $("#Roles_c_rol").val("");
    $("#Roles_n_nombre").val("");
    $("#Roles_n_descripcion").val("");
    fn_generarid();
}
function fn_nuevo_acceso(){
    //$('#jqxTabs_accesos').jqxTabs({ disabled:false }); 
    $("#btngenerarid_sistema").css("display","inline");
    $("#esNuevo_acceso").val("1");
    $("#titulo_poput_mantenedor_accesos").html("Nuevo Menú");
    $("#popup_mantenedor_accesos").jqxWindow('open'); 
    $("#Sistemas_n_sistem_desc").focus(); 
    $("#Sistemas_n_sistem_desc").val("");
    $("#Sistemas_n_icono").val("fa-folder");
    $("#Sistemas_i_orden").val("");
    fn_generarid_sistemas();


    //menues
    $("#SistemasMenues_n_modulo_controller").val("");
    $("#SistemasMenues_n_accion").val("");
    $("#SistemasMenues_n_titulo").val("");
    $("#SistemasMenues_n_icono").val("");
    $("#btngenerarid_menues").css("display","inline");
    fn_generarid_menues();

    //accion 
    $("#MenuesAcciones_c_accion").val(""); 
    $("#MenuesAcciones_c_sismen").val(""); 
    $("#MenuesAcciones_n_controlador").val(""); 
    $("#MenuesAcciones_n_funcion").val("");
    $("#MenuesAcciones_n_titulo").val(""); 
    $("#MenuesAcciones_n_descripcion").val(""); 
    $("#MenuesAcciones_i_es_pagina").val("0"); 
    $("#btngenerarid_accion").css("display","inline");
    $("#chkaccionespagina").jqxCheckBox({ checked: true });

    fn_generarid_accion()
}
function fn_editar(){ 
    var rowindex = $('#jqxgrid_roles').jqxGrid('getselectedrowindex');  
    if(rowindex!=-1){ 
        $("#esNuevo").val("2");
        $("#btngenerarid").css("display","none"); 
        var data = $('#jqxgrid_roles').jqxGrid('getrowdata', rowindex); 

        $("#Roles_c_rol").val(data.c_rol );
        $("#titulo_poput_mantenedor").html("Editar Rol - "+data.c_rol);
        $("#Roles_n_nombre").val(data.n_nombre);
        $("#Roles_n_descripcion").val(data.n_descripcion );
        $("#popup_mantenedor").jqxWindow('open'); 
        $("#Roles_n_nombre").focus();
    }else{
 
        fn_mostrar_msj("ico_alerta.jpg","Seleccione una fila de la tabla para modificar","#jqxgrid_roles",'fn_cerrar_poput_msjs()',"Aceptar");
        var offset = $("#jqxgrid_roles").offset();  
        $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
        position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 
          $("#btncancelarMsj").css("display","none");
        $("#btnaceptarMsj").focus();
    } 
 

}
function fn_editar_acceso(){ 
    var item = $('#jqxTree_menues').jqxTree('getSelectedItem');
    //$('#jqxTabs_accesos').jqxTabs({ disabled:false }); 
    if(item){  
        $("#esNuevo_acceso").val("2"); 
        if(item.label.substring(0, 1)=="1"){ 
$('.nav-tabs a[href="#tbnivel1"]').tab('show');
            idd= item.label.substring(1,item.label.indexOf("-")); 
            var url1 = urlsistemas+"/ver";
            $.ajax({
                    type: "POST",
                    url:  url1,
                    dataType: 'json', 
                    data:  {c_sistem:idd} ,  
                    beforeSend: function() {   
                        $("#cargandomenus").css("display", "inline");
                        $("#btneditar_acceso").attr("disabled","disabled") ; 
                      },
                    success: function(arreglo){ 
                            //$('#jqxTabs_accesos').jqxTabs({ disabled:true });  
                        fn_cerrar_ventana_msjs_menu();
                        $("#btneditar_acceso").removeAttr("disabled");   
                        $("#cargandomenus").css("display", "none"); 
                        if(arreglo.error=="0"){
                            $("#btngenerarid_sistema").css("display","none");   
                            $("#Sistemas_c_sistem").val(arreglo.c_sistem);
                            $("#titulo_poput_mantenedor").html("Editar Sistema - "+arreglo.c_sistem);
                            $("#Sistemas_n_sistem_desc").val(arreglo.n_sistem_desc);
                            $("#Sistemas_n_icono").val(arreglo.n_icono );
                            $("#Sistemas_i_orden").val(arreglo.i_orden);
                            $("#popup_mantenedor_accesos").jqxWindow('open'); 
                            $("#Sistemas_n_sistem_desc").focus();

                        }
                        if(arreglo.error=="1"){
                            fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                        }
                    },
                    error: function(xhr){   
                        fn_cerrar_ventana_msjs_menu();
                        $("#btneditar_acceso").removeAttr("disabled"); 
                        $("#cargandomenus").css("display", "none"); 
                        fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
                    }
              });
                         
        }
        if(item.label.substring(0, 1)=="2"){
$('.nav-tabs a[href="#tbnivel2"]').tab('show') ;
            idd= item.label.substring(1,item.label.indexOf("-")); 
            var url1 = urlmenues+"/ver";
            $.ajax({
                    type: "POST",
                    url:  url1,
                    dataType: 'json', 
                    data:  {c_sismen:idd} ,  
                    beforeSend: function() {   
                        $("#cargandomenus").css("display", "inline");
                        $("#btneditar_acceso").attr("disabled","disabled") ; 
                      },
                    success: function(arreglo){  
                            //$('#jqxTabs_accesos').jqxTabs({ disabled:true }); 
                        fn_cerrar_ventana_msjs_menu();
                        $("#btneditar_acceso").removeAttr("disabled");   
                        $("#cargandomenus").css("display", "none"); 
                        if(arreglo.error=="0"){
                            $("#btngenerarid_menues").css("display","none");   
                            $("#SistemasMenues_c_sismen").val(arreglo.c_sismen);
                            $("#SistemasMenues_c_sistem").val(arreglo.c_sistem);
                            $("#SistemasMenues_c_sismen_padre").val(arreglo.c_sismen_padre);
                            $("#SistemasMenues_n_modulo_controller").val(arreglo.n_modulo_controller);
                            $("#SistemasMenues_n_accion").val(arreglo.n_accion);
                            $("#SistemasMenues_n_titulo").val(arreglo.n_titulo);
                            $("#SistemasMenues_n_icono").val(arreglo.n_icono);
                            $("#SistemasMenues_i_orden").val(arreglo.i_orden);
                            $("#titulo_poput_mantenedor").html("Editar Menu - "+arreglo.sismen);
                            $ 
                            $("#popup_mantenedor_accesos").jqxWindow('open'); 
                            $("#SistemasMenues_c_sistem").focus();

                        }
                        if(arreglo.error=="1"){
                            fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                        } 
                    },
                    error: function(xhr){   
                        fn_cerrar_ventana_msjs_menu();
                        $("#btneditar_acceso").removeAttr("disabled"); 
                        $("#cargandomenus").css("display", "none"); 
                        fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
                    }
              });
        } 
        if(item.label.substring(0, 1)=="3"){ 
            idd= item.label.substring(1,item.label.indexOf("-")); 
            var url1 = urlacciones+"/ver"; 
$('.nav-tabs a[href="#tbnivel3"]').tab('show') ;
            $.ajax({
                    type: "POST",
                    url:  url1,
                    dataType: 'json', 
                    data:  {c_accion:idd} ,  
                    beforeSend: function() {   
                        $("#cargandomenus").css("display", "inline");
                        $("#btneditar_acceso").attr("disabled","disabled") ; 
                      },
                    success: function(arreglo){  
                            //$('#jqxTabs_accesos').jqxTabs({ disabled:true }); 
                        fn_cerrar_ventana_msjs_menu();
                        $("#btneditar_acceso").removeAttr("disabled");   
                        $("#cargandomenus").css("display", "none"); 
                        if(arreglo.error=="0"){
                            $("#btngenerarid_accion").css("display","none");   
                            $("#MenuesAcciones_c_accion").val(arreglo.c_accion);
                            $("#MenuesAcciones_c_sismen").val(arreglo.c_sismen);
                            $("#MenuesAcciones_n_controlador").val(arreglo.n_controlador);
                            $("#MenuesAcciones_n_funcion").val(arreglo.n_funcion);
                            $("#MenuesAcciones_n_titulo").val(arreglo.n_titulo);
                            $("#MenuesAcciones_n_descripcion").val(arreglo.n_descripcion);
                            $("#MenuesAcciones_i_es_pagina").val(arreglo.i_es_pagina);
                            if(arreglo.i_es_pagina=="1"){
                                $("#chkaccionespagina").jqxCheckBox({ checked: true });
                            }else{
                                $("#chkaccionespagina").jqxCheckBox({ checked: false });
                            }
                            $("#titulo_poput_mantenedor").html("Editar Acción - "+arreglo.c_accion);
                             
                            $("#popup_mantenedor_accesos").jqxWindow('open'); 
                            $("#MenuesAcciones_n_controlador").focus();
                        }
                        if(arreglo.error=="1"){
                            fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                        } 
                    },
                    error: function(xhr){   
                        fn_cerrar_ventana_msjs_menu();
                        $("#btneditar_acceso").removeAttr("disabled"); 
                        $("#cargandomenus").css("display", "none"); 
                        fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
                    }
              });
        } 

            
    }else{
 
        fn_mostrar_msj("ico_alerta.jpg","Seleccione el item a editar del árbol","#jqxTree_menues",'fn_cerrar_poput_msjs()',"Aceptar");
        var offset = $("#jqxTree_menues").offset();  
        $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
        position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 
          $("#btncancelarMsj").css("display","none");
        $("#btnaceptarMsj").focus();
    } 
    

}
function fn_cancelar(){

    $("#popup_mantenedor").jqxWindow('close'); 
}
function fn_cancelar_acceso(){

    $("#popup_mantenedor_accesos").jqxWindow('close'); 
}
function fn_eliminar(){
    var rowindex = $('#jqxgrid_roles').jqxGrid('getselectedrowindex');  

      if(rowindex!=-1){
          
            var data = $('#jqxgrid_roles').jqxGrid('getrowdata', rowindex); 
          $("#popupmsjAlerta").jqxWindow({  width: 300,height:110});
          fn_mostrar_msj("ico_pregunta.jpg","¿Desea eliminar el cargo seleccionado y su contrato?","#jqxgrid_roles","fn_eliminar_rol('"+data.c_rol+"')","Continuar");
          var offset = $("#jqxgrid_roles").offset();  
        $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
          position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 

          $("#btnsalirMsj").css("display","inline");
          $("#btnaceptarmsj").focus();
      }else{ 
            fn_mostrar_msj("ico_alerta.jpg","Seleccione una fila de la tabla para eliminar","#jqxgrid_roles",'fn_cerrar_poput_msjs()',"Aceptar");
            var offset = $("#jqxgrid_roles").offset();  
            $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
            position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 
          $("#btncancelarMsj").css("display","none");
            $("#btnaceptarMsj").focus();
      } 
}
function fn_eliminar_rol(id){ 
        var url1 = urlrol+"/Eliminar";
        $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  {c_rol:id} ,  
            beforeSend: function() {   
                $("#cargando").css("display", "inline");
                $("#btnguardar_rol").attr("disabled","disabled") ;
                $("#btncancelar_rol").attr("disabled","disabled") ;
              },
            success: function(arreglo){  
                fn_cerrar_ventana_msjs_menu();
                $("#btnguardar_rol").removeAttr("disabled"); 
                $("#btncancelar_rol").removeAttr("disabled");  
                $("#msjnotifrol").html(arreglo.msj);
                $("#cargando").css("display", "none"); 
                if(arreglo.error=="0"){
                    fn_notificacion_general("success","Aviso","Rol eliminado","","");
                    CargarGrilla_roles();
                    $("#popup_mantenedor").jqxWindow('close'); 
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                } 
            },
            error: function(xhr){   
                fn_cerrar_ventana_msjs_menu();
                $("#cargando").css("display", "none"); 
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
      });
}
function fn_generarid(){
    var url1 = urlrol+"/Generar_id";
    $.ajax({
                type: "POST",
                url:  url1,
                cache:false,
                    contentType: false,
                    processData: false,
                beforeSend: function() {   
                    $("#Roles_c_rol").val("");
                    $("#cargando_generar_id").css("display", "inline");
                  },
                success: function(nuevoid){  
                    $("#cargando_generar_id").css("display", "none"); 
                    $("#Roles_c_rol").val(nuevoid);
                },
                error: function(xhr){
                  $("#cargando_generar_id").css("display", "none");
                    
                }
          });
}
function fn_generarid_sistemas(){
    var url1 = urlsistemas+"/Generar_id";
    $.ajax({
                type: "POST",
                url:  url1,
                cache:false,
                    contentType: false,
                    processData: false,
                beforeSend: function() {   
                    $("#Sistemas_c_sistem").val("");
                    $("#cargando_generar_id_sistema").css("display", "inline");
                  },
                success: function(nuevoid){  
                    $("#cargando_generar_id_sistema").css("display", "none"); 
                    $("#Sistemas_c_sistem").val(nuevoid);
                },
                error: function(xhr){
                  $("#cargando_generar_id_sistema").css("display", "none");
                    
                }
          });
}
function fn_generarid_menues(){
    var url1 = urlmenues+"/Generar_id";
    $.ajax({
                type: "POST",
                url:  url1,
                cache:false,
                    contentType: false,
                    processData: false,
                beforeSend: function() {   
                    $("#SistemasMenues_c_sismen").val("");
                    $("#cargando_generar_id_menues").css("display", "inline");
                  },
                success: function(nuevoid){  
                    $("#cargando_generar_id_menues").css("display", "none"); 
                    $("#SistemasMenues_c_sismen").val(nuevoid);
                },
                error: function(xhr){
                  $("#cargando_generar_id_menues").css("display", "none");
                    
                }
          });
}
function fn_generarid_accion(){
    var url1 = urlacciones+"/Generar_id";
    $.ajax({
                type: "POST",
                url:  url1,
                cache:false,
                    contentType: false,
                    processData: false,
                beforeSend: function() {   
                    $("#MenuesAcciones_c_accion").val("");
                    $("#cargando_generar_id_accion").css("display", "inline");
                  },
                success: function(nuevoid){  
                    $("#cargando_generar_id_accion").css("display", "none"); 
                    $("#MenuesAcciones_c_accion").val(nuevoid);
                },
                error: function(xhr){
                  $("#cargando_generar_id_accion").css("display", "none");
                    
                }
          });
}
function fn_guardar(){
    if(validar()){
        var url1 = urlrol+"/Guardar";
        var msjjj ="Rol Creado"
        if($("#esNuevo").val()=="2"){  
             url1=urlrol+"/Actualizar";
            msjjj ="Rol actualizado"
        } 
        var formData = new FormData(document.forms.namedItem("roles-form")); 
        $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  formData , 
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function() {   
                $("#cargando").css("display", "inline");
                $("#btnguardar_rol").attr("disabled","disabled") ;
                $("#btncancelar_rol").attr("disabled","disabled") ;
              },
            success: function(arreglo){  
                $("#btnguardar_rol").removeAttr("disabled"); 
                $("#btncancelar_rol").removeAttr("disabled");   
                $("#cargando").css("display", "none"); 
                if(arreglo.error=="0"){ 
                    fn_notificacion_general("success","Aviso",msjjj,"","");
                    CargarGrilla_roles();
                    $("#popup_mantenedor").jqxWindow('close'); 
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,"",arreglo.info); 
                } 
            },
            error: function(xhr){   
                fn_cerrar_ventana_msjs_menu();
                $("#cargando").css("display", "none");  
                $("#btnguardar_rol").removeAttr("disabled") ; 
                $("#btncancelar_rol").removeAttr("disabled") ;   
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
      });
    }
}
function validar(){
    if($("#Roles_c_rol").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Vuelva a generar el código del rol","#Roles_c_rol","$('#popupmsjAlerta').jqxWindow('close')","Aceptar");
        $("#btncancelarMsj").css("display","none");
        return false;
    }
    if($("#Roles_n_nombre").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese un nombre para el Rol","#Roles_n_nombre","$('#popupmsjAlerta').jqxWindow('close')","Aceptar");
        $("#btncancelarMsj").css("display","none");
        return false;
    } 
    return true;
}
function fn_guardar_acceso(){
    //var nrotab= $('#jqxTabs_accesos').jqxTabs('val');
    var nrotab=0;
     if($('#tablistrole2').hasClass("active"))
        nrotab=1;
     if($('#tablistrole3').hasClass("active"))
        nrotab=2;
 
    if(nrotab=="0"){
        if(validar_sistemas()){
            var url1 = urlsistemas+"/Guardar";
            var msjjj ="Rol Creado";
            if($("#esNuevo_acceso").val()=="2"){  
                 url1=urlsistemas+"/Actualizar";
                msjjj ="Rol actualizado";
            } 
            var formData = new FormData(document.forms.namedItem("sistemas-form")); 
            $.ajax({
                type: "POST",
                url:  url1,
                dataType: 'json', 
                data:  formData , 
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function() {   
                    $("#cargando_acceso").css("display", "inline");
                    $("#btnguardar_acceso").attr("disabled","disabled") ;
                    $("#btncancelar_acceso").attr("disabled","disabled") ;
                  },
                success: function(arreglo){  
                    $("#btnguardar_acceso").removeAttr("disabled"); 
                    $("#btncancelar_acceso").removeAttr("disabled");   
                    $("#cargando_acceso").css("display", "none"); 
                    if(arreglo.error=="0"){ 
                        fn_notificacion_general("success","Aviso",msjjj,"","");
                        cargar_treeviewmenus();
                        $("#popup_mantenedor_accesos").jqxWindow('close'); 
                    }
                    if(arreglo.error=="1"){
                        fn_notificacion_general("error","Aviso",arreglo.msj,"click aqui para ver detalle",arreglo.info); 
                    } 
                },
                error: function(xhr){   
                    fn_cerrar_ventana_msjs_menu();
                    $("#cargando_acceso").css("display", "none");  
                    $("#btnguardar_acceso").removeAttr("disabled") ; 
                    $("#btncancelar_acceso").removeAttr("disabled") ;   
                    fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
                }
          });
        }
    }
    if(nrotab=="1"){ 
        if(validar_menues()){
            var url1 = urlmenues+"/Guardar";
            var msjjj ="Menú Creado";
            if($("#esNuevo_acceso").val()=="2"){  
                 url1=urlmenues+"/Actualizar";
                msjjj ="Menú actualizado";
            } 
            var formData = new FormData(document.forms.namedItem("sistemas-menues-form")); 
            $.ajax({
                type: "POST",
                url:  url1,
                dataType: 'json', 
                data:  formData , 
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function() {   
                    $("#cargando_acceso").css("display", "inline");
                    $("#btnguardar_acceso").attr("disabled","disabled") ;
                    $("#btncancelar_acceso").attr("disabled","disabled") ;
                  },
                success: function(arreglo){  
                    $("#btnguardar_acceso").removeAttr("disabled"); 
                    $("#btncancelar_acceso").removeAttr("disabled");   
                    $("#cargando_acceso").css("display", "none"); 
                    if(arreglo.error=="0"){ 
                        fn_notificacion_general("success","Aviso",msjjj,"","");
                        cargar_treeviewmenus();
                        $("#popup_mantenedor_accesos").jqxWindow('close'); 
                    }
                    if(arreglo.error=="1"){
                        fn_notificacion_general("error","Aviso",arreglo.msj,"click aqui para ver detalle",arreglo.info); 
                    } 
                },
                error: function(xhr){   
                    fn_cerrar_ventana_msjs_menu();
                    $("#cargando_acceso").css("display", "none");  
                    $("#btnguardar_acceso").removeAttr("disabled") ; 
                    $("#btncancelar_acceso").removeAttr("disabled") ;   
                    fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
                }
          });
        }
    }
    if(nrotab=="2"){
        if(validar_acciones()){
            var url1 = urlacciones+"/Guardar";
            var msjjj ="Acción Creada";
            if($("#esNuevo_acceso").val()=="2"){  
                 url1=urlmenues+"/Actualizar";
                msjjj ="Acción actualizada";
            } 
            var formData = new FormData(document.forms.namedItem("menues-acciones-form")); 
            $.ajax({
                type: "POST",
                url:  url1,
                dataType: 'json', 
                data:  formData , 
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function() {   
                    $("#cargando_acceso").css("display", "inline");
                    $("#btnguardar_acceso").attr("disabled","disabled") ;
                    $("#btncancelar_acceso").attr("disabled","disabled") ;
                  },
                success: function(arreglo){  
                    $("#btnguardar_acceso").removeAttr("disabled"); 
                    $("#btncancelar_acceso").removeAttr("disabled");   
                    $("#cargando_acceso").css("display", "none"); 
                    if(arreglo.error=="0"){ 
                        fn_notificacion_general("success","Aviso",msjjj,"","");
                        cargar_treeviewmenus();
                        $("#popup_mantenedor_accesos").jqxWindow('close'); 
                    }
                    if(arreglo.error=="1"){
                        fn_notificacion_general("error","Aviso",arreglo.msj,"click aqui para ver detalle",arreglo.info); 
                    } 
                },
                error: function(xhr){   
                    fn_cerrar_ventana_msjs_menu();
                    $("#cargando_acceso").css("display", "none");  
                    $("#btnguardar_acceso").removeAttr("disabled") ; 
                    $("#btncancelar_acceso").removeAttr("disabled") ;   
                    fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
                }
          });
        } 
    }
        
}
function validar_sistemas(){
    if($("#Sistemas_c_sistem").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Vuelva a generar el código del sistema","#Sistemas_c_sistem","$('#popupmsjAlerta').jqxWindow('close');$('#btngenerarid_sistema').focus()","Aceptar");
        $("#btncancelarMsj").css("display","none"); 
        return false;
    }
    if($("#Sistemas_n_sistem_desc").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese un nombre para el Sistema","#Sistemas_n_sistem_desc","$('#popupmsjAlerta').jqxWindow('close');$('#Sistemas_n_sistem_desc').focus()","Aceptar");
        $("#btncancelarMsj").css("display","none");
        $('#Sistemas_n_sistem_desc').focus();
        return false;
    } 
    if($("#Sistemas_i_orden").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese el N° de orden","#Sistemas_i_orden","$('#popupmsjAlerta').jqxWindow('close');$('#Sistemas_i_orden').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none");
        $("#Sistemas_i_orden").focus();
        return false;
    } 
    return true;
}
function validar_menues(){
    if($("#SistemasMenues_c_sismen").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Vuelva a generar el código del menú","#SistemasMenues_c_sismen","$('#popupmsjAlerta').jqxWindow('close');$('#btngenerarid_menues').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none"); 
        return false;
    }
    if($("#SistemasMenues_c_sistem").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Seleccione un sistema","#cbomenues_c_sistem","$('#popupmsjAlerta').jqxWindow('close');$('#cbomenues_c_sistem').jqxComboBox('focus')","Aceptar");
        $("#btncancelarMsj").css("display","none"); 
        $("#cbomenues_c_sistem").jqxComboBox('focus');
        return false;
    } 
    if($("#SistemasMenues_n_modulo_controller").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese el nombre del controlador","#SistemasMenues_n_modulo_controller","$('#popupmsjAlerta').jqxWindow('close');$('#SistemasMenues_n_modulo_controller').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none");
        $("#SistemasMenues_n_modulo_controller").focus();
        return false;
    } 
    if($("#SistemasMenues_n_accion").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese el nombre de la acción","#SistemasMenues_n_accion","$('#popupmsjAlerta').jqxWindow('close');$('#SistemasMenues_n_accion').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none");
        $("#SistemasMenues_n_accion").focus();
        return false;
    } 
    if($("#SistemasMenues_n_titulo").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese el Título del menú","#SistemasMenues_n_titulo","$('#popupmsjAlerta').jqxWindow('close');$('#SistemasMenues_n_titulo').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none");
        $("#SistemasMenues_n_titulo").focus();
        return false;
    } 
    if($("#SistemasMenues_n_icono").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Seleccione un icono para el menú","#cbosistemamenues_n_icono","$('#popupmsjAlerta').jqxWindow('close');$('#cbosistemamenues_n_icono').jqxComboBox('focus');","Aceptar");
        $("#btncancelarMsj").css("display","none");
        $("#cbosistemamenues_n_icono").jqxComboBox('focus');
        return false;
    } 
    if($("#SistemasMenues_i_orden").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese el N° de orden","#SistemasMenues_i_orden","$('#popupmsjAlerta').jqxWindow('close');$('#cbosistemamenues_n_icono').jqxNumberInput('focus');","Aceptar");
        $("#btncancelarMsj").css("display","none"); 
        $('#cbosistemamenues_n_icono').jqxNumberInput('focus');
        return false;
    } 
    if($("#SistemasMenues_f_habilitado").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Defina el estado del menú","#SistemasMenues_f_habilitado","$('#popupmsjAlerta').jqxWindow('close');","Aceptar");
        $("#btncancelarMsj").css("display","none");
         
        return false;
    } 
    return true;
}
function validar_acciones(){
    if($("#MenuesAcciones_c_accion").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Vuelva a generar el código del menú","#MenuesAcciones_c_accion","$('#popupmsjAlerta').jqxWindow('close');$('#btngenerarid_accion').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none");  
        return false;
    }
    /*if($("#MenuesAcciones_c_sismen").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Seleccione un sub menú","#jqxcbosistemas_menues","$('#popupmsjAlerta').jqxWindow('close');$('#jqxcbosistemas_menues').jqxComboBox('focus');","Aceptar");
        $("#btncancelarMsj").css("display","none");  
        return false;
    }*/
    if($("#MenuesAcciones_n_controlador").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese el nombre del controlador","#MenuesAcciones_n_controlador","$('#popupmsjAlerta').jqxWindow('close');$('#MenuesAcciones_n_controlador').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none");  
        return false;
    }
    if($("#MenuesAcciones_n_funcion").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese el nombre de la función","#MenuesAcciones_n_funcion","$('#popupmsjAlerta').jqxWindow('close');$('#MenuesAcciones_n_funcion').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none");  
        return false;
    }
    if($("#MenuesAcciones_n_titulo").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese un título","#MenuesAcciones_n_titulo","$('#popupmsjAlerta').jqxWindow('close');$('#MenuesAcciones_n_titulo').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none");  
        return false;
    }
    if($("#MenuesAcciones_n_descripcion").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Ingrese una descripción breve","#SistemasMenues_i_orden","$('#popupmsjAlerta').jqxWindow('close');$('#MenuesAcciones_n_descripcion').focus();","Aceptar");
        $("#btncancelarMsj").css("display","none");  
        return false;
    }
    if($("#MenuesAcciones_i_es_pagina").val().trim()=="")
    {
        fn_mostrar_msj("ico_alerta.jpg","Indique si la función direcciona a una pagina completa","#SistemasMenues_i_orden","$('#popupmsjAlerta').jqxWindow('close');","Aceptar");
        $("#btncancelarMsj").css("display","none");  
        return false;
    }
    return true;
}
function fn_guardar_asignacion_acciones(){
    var rowindex = $('#jqxgrid_roles').jqxGrid('getselectedrowindex');  
    var data = $('#jqxgrid_roles').jqxGrid('getrowdata', rowindex); 
    var items = $('#jqxTree_menues').jqxTree('getCheckedItems');
    var fruits = [100]; 
    var nnn=0;
    for (var i = 0; i < items.length; i++){
        var item = items[i];
        if(item.label.substring(0, 1)=="3"){
            fruits[nnn] = item.label.substring(1,item.label.indexOf("-")); 
            nnn=nnn+1;
        } 
    }
    var jsonString = JSON.stringify(fruits);
    var url1 = urlmenuesacciones+"/asignar_rol_accion"; 
    $.ajax({
                type: "POST",
                url:  url1,
                dataType: 'json', 
                data:  {
                        c_rol:data.c_rol,
                        acciones:jsonString
                } ,   
                beforeSend: function() {   
                    $("#cargandomenus").css("display", "inline");  
                    $("#btnasignar_acceso").attr("disabled","disabled") ;
                  },
                success: function(arreglo){  
                    $("#btnasignar_acceso").removeAttr("disabled");  
                    $("#cargandomenus").css("display", "none");
                    if(arreglo.error==0){ 
                        fn_notificacion_general("success","Aviso","Accesos del Rol actualizados","","");  
                    }
                    if(arreglo.error==1){
                        fn_notificacion_general("error","Aviso",arreglo.msj,"",arreglo.info); 
                    } 
                     
                },
                error: function(xhr){
                    $("#btnasignar_acceso").removeAttr("disabled");  
                    $("#cargandomenus").css("display", "none");
                    fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
 
                }
          }); 
}
function fn_eliminar_acceso(){
     
    var item = $('#jqxTree_menues').jqxTree('getSelectedItem');
        
      if(item){
        //alert(item.label); 
          var funcion ="";
          var nro = item.label.substring(0,1) ;
          var idd=item.label.substring(1,item.label.indexOf("-")) 
          if(nro=="1"){
            funcion="fn_eliminar_sistema('"+idd+"')";
          }
          if(nro=="2"){
            funcion="fn_eliminar_menues('"+idd+"')";
          }
          if(nro=="3"){
            funcion="fn_eliminar_accion('"+idd+"')";
          }

          $("#popupmsjAlerta").jqxWindow({  width: 300,height:110});
          fn_mostrar_msj("ico_pregunta.jpg","¿Desea eliminar el menu '"+item.label.substring(item.label.indexOf("-")+1,item.length) +"'?","#jqxgrid_roles",funcion,"Continuar");
          var offset = $("#jqxTree_menues").offset();  
        $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
          position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 200 }} ); 

          $("#btnsalirMsj").css("display","inline");
          $("#btnaceptarmsj").focus();
      }else{ 
            fn_mostrar_msj("ico_alerta.jpg","Seleccione un item del árbol de menús para eliminar","#jqxTree_menues",'fn_cerrar_poput_msjs()',"Aceptar");
            var offset = $("#jqxTree_menues").offset();  
            $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
            position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 200 }} ); 
          $("#btncancelarMsj").css("display","none");
            $("#btnaceptarMsj").focus();
      } 
}
function fn_eliminar_sistema(id){ 
        var url1 = urlsistemas+"/Eliminar";
        $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  {c_sistem:id} ,  
            beforeSend: function() {   
                $("#cargandomenus").css("display", "inline");
                $("#btnnuevo_acceso").attr("disabled","disabled") ;
                $("#btneditar_acceso").attr("disabled","disabled") ;
                $("#btnasignar_acceso").attr("disabled","disabled") ; 
              },
            success: function(arreglo){  
                fn_cerrar_ventana_msjs_menu();
                $("#btnnuevo_acceso").removeAttr("disabled"); 
                $("#btneditar_acceso").removeAttr("disabled");  
                $("#btnasignar_acceso").removeAttr("disabled");  
                $("#msjnotifrol").html(arreglo.msj);
                $("#cargandomenus").css("display", "none"); 
                if(arreglo.error=="0"){
                    fn_notificacion_general("success","Aviso","Menú eliminado","","");
                    cargar_treeviewmenus();
                    $("#popup_mantenedor").jqxWindow('close'); 
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                } 
            },
            error: function(xhr){   
                fn_cerrar_ventana_msjs_menu();
                $("#cargandomenus").css("display", "none"); 
                $("#btnnuevo_acceso").removeAttr("disabled"); 
                $("#btneditar_acceso").removeAttr("disabled");  
                $("#btnasignar_acceso").removeAttr("disabled");  
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
      });
}
function fn_eliminar_menues(id){ 
        var url1 = urlmenues+"/Eliminar";
        $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  {c_sismen:id} ,  
            beforeSend: function() {   
                $("#cargandomenus").css("display", "inline");
                $("#btnnuevo_acceso").attr("disabled","disabled") ;
                $("#btneditar_acceso").attr("disabled","disabled") ;
                $("#btnasignar_acceso").attr("disabled","disabled") ; 
              },
            success: function(arreglo){  
                fn_cerrar_ventana_msjs_menu();
                $("#btnnuevo_acceso").removeAttr("disabled"); 
                $("#btneditar_acceso").removeAttr("disabled");  
                $("#btnasignar_acceso").removeAttr("disabled");  
                $("#msjnotifrol").html(arreglo.msj);
                $("#cargandomenus").css("display", "none"); 
                if(arreglo.error=="0"){
                    fn_notificacion_general("success","Aviso","Menú eliminado","","");
                    cargar_treeviewmenus();
                    $("#popup_mantenedor").jqxWindow('close'); 
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                }
            },
            error: function(xhr){   
                fn_cerrar_ventana_msjs_menu();
                $("#cargandomenus").css("display", "none"); 
                $("#btnnuevo_acceso").removeAttr("disabled"); 
                $("#btneditar_acceso").removeAttr("disabled");  
                $("#btnasignar_acceso").removeAttr("disabled");  
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
      });
}
function fn_eliminar_accion(id){ 
        var url1 = urlacciones+"/Eliminar";
        $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  {c_accion:id} ,  
            beforeSend: function() {   
                $("#cargandomenus").css("display", "inline");
                $("#btnnuevo_acceso").attr("disabled","disabled") ;
                $("#btneditar_acceso").attr("disabled","disabled") ;
                $("#btnasignar_acceso").attr("disabled","disabled") ; 
              },
            success: function(arreglo){  
                fn_cerrar_ventana_msjs_menu();
                $("#btnnuevo_acceso").removeAttr("disabled"); 
                $("#btneditar_acceso").removeAttr("disabled");  
                $("#btnasignar_acceso").removeAttr("disabled");  
                $("#msjnotifrol").html(arreglo.msj);
                $("#cargandomenus").css("display", "none"); 
                if(arreglo.error=="0"){
                    fn_notificacion_general("success","Aviso","Menú eliminado","","");
                    cargar_treeviewmenus();
                    $("#popup_mantenedor").jqxWindow('close'); 
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                }
            },
            error: function(xhr){   
                fn_cerrar_ventana_msjs_menu();
                $("#cargandomenus").css("display", "none"); 
                $("#btnnuevo_acceso").removeAttr("disabled"); 
                $("#btneditar_acceso").removeAttr("disabled");  
                $("#btnasignar_acceso").removeAttr("disabled");  
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
      });
}
function fn_eliminar_rol_accion(){

}