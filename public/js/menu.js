
function validar_sesion_estado() {
      $.ajax({
            type: "POST",
            url:  urlusuario+"/validar_sesion_estado",  
            dataType: 'json', 
            beforeSend: function() {   
                

            },
            success: function(arreglo){  
                if(arreglo.error=="0"){
                      alert("sas");
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                }
            },
            error: function(xhr){    

                fn_notificacion_general("error","Aviso sesion","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
        });
}
function fn_notificacion_general(tipo,titulo,msj,info,detalle){
  if(tipo=="error"){
    $.amaran({
                content:{
                    title:titulo,
                    message:msj,
                    info:info,
                    icon:"fa fa-ban"
                },
                'position'  :'top right',
                'theme'     :'awesome error',
                'outEffect'  :'slideRight',
                'cssanimationIn'    :'tada',
                'cssanimationOut'   :'rollOut',
                'onClick'          :function()
                {
                    if(detalle.trim().length>0){
                      $("#msjnotif_general_errores_detallados").html(detalle); 
                      $("#popup_general_errores_detallados").jqxWindow('open'); 
                    }
                      
                }
            });
  }
  if(tipo=="success"){
    $.amaran({
                content:{
                    title:titulo,
                    message:msj,
                    info:info,
                    icon:"fa fa-check-circle"
                },
                'position'  :'top right',
                'theme'     :'awesome ok',
                'outEffect'  :'slideRight'
            });
  }
  if(tipo=="alerta"){
    $.amaran({
                content:{
                    title:titulo,
                    message:msj,
                    info:info,
                    icon:"fa fa-exclamation-triangle"
                },
                'position'  :'top right',
                'theme'     :'awesome yellow',
                'outEffect'  :'slideRight',
                'cssanimationIn'    :'shake',
                'cssanimationOut'   :'fadeOutRight',
                'outEffect'         :'slideRight'
            });
  }
    
} 
function fn_mostrar_msj(imagen,msj,control,funcion,btnok){
    msj =  '<div class="col-md-2">'+
              '<img  src="'+urlproject+"/images/"+imagen+'"/>'+
            '</div>'+
            '<div class="col-md-10">'+
              '<div class="row">'+ 
                '<div class="col-md-12"> '+msj+
                '</div>'+
              '</div>'+
              '<div class="row" style="padding-top:5px;">'+
                '<div class="col-md-12">'+  
                  '<button id="btnaceptarMsj" type="button" onclick="'+funcion+'" class="btn btn-xs btn-default">'+
                    '<span class="glyphicon glyphicon-check"></span> '+btnok+
                  '</button>'+
                  '<button type="button" id="btncancelarMsj" onclick="fn_cerrar_ventana_msjs_menu()" class="btn btn-xs btn-default">'+
                    '<span class="glyphicon glyphicon-share"></span> Cancelar'+
                  '</button>'+ 
                '</div>'+
              '</div>'+
            '</div>' ;
        $("#mostrarmsjj").html(msj);
        
        $("#popupmsjAlerta").jqxWindow('open'); 
  }
function fn_cerrar_ventana_msjs_menu(){
    $('#popupmsjAlerta').jqxWindow('close');
}
function fn_msj_confirmacion(){
  	
  	$("#popupmsjAlerta").jqxWindow({  width: 300,height:110});
  	var offset = $("#btnmenuuser").offset();  
    $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),
    	position: { x: parseInt(offset.left) - 140, y: parseInt(offset.top) + 50 }} ); 

    fn_mostrar_msj("ico_pregunta.jpg","¿Desea cerrar sesión?","#btncerrarsesion","fn_cerrarsesion()","Continuar");
    $("#btncancelarMsj").css("display","inline");
}
function fn_mostrar_msj_clave_confirm(imagen,titulo,msj,fn_aceptar,descaceptar,encontrol,largo,alto){
    $("#txtclaveconfirm43r3456").val("") ;
    $("#popup_confirmar_clave").jqxWindow({ theme:"ui-smoothness",
              width: largo,height:alto});

      $("#titulo_popup_confirmar_clave").html(titulo);
      $("#mostrarmsjj43r3456").html(msj);
      $("#btnaceptar43r3456").attr("onclick",fn_aceptar);
      $("#btnaceptar43r3456").html(descaceptar);
      $("#popup_confirmar_clave").jqxWindow('open'); 

      var offset = $(encontrol).offset();  
    $("#popup_confirmar_clave").jqxWindow({
      position: { x: parseInt(offset.left) - 140, y: parseInt(offset.top) + 50 }} ); 
  }

  function fn_cancelar_poput_clave_confirm(){
    $("#popup_confirmar_clave").jqxWindow('close'); 
  }
function fn_cerrarsesion(){
	//alert(urlusuario+"/CerrarSesion");
	$.ajax({
            url: urlusuario+"/CerrarSesion", 
            type: 'post',
            beforeSend: function() {    

              },
            success: function(data){
                  
				if(data=="1"){
           			 $('#popupmsjAlerta').jqxWindow('close');
                $(location).attr('href', urlindex+"/"+"index"); 
	            	
           		}else{
           			 
           		}
            },
            error: function(xhr){ 

        		//$("#cargando").css("display", "none");
              //swal("Ocurrió un error!", "Ocurrio un error al conectar con el servidor!", "error" );
              	$("#popupmsjAlerta").jqxWindow({  width: 300,height:100}); 
              	fn_mostrar_msj("ico_Error.gif","Ocurrio un error al conectar con el servidor!","#LoginForm_username","$('#popupmsjAlerta').jqxWindow('close')","Aceptar");
            	$("#btncancelarMsj").css("display","none");
            }
         });	
}
function fn_cerrar_poput_msjs(){
    $('#popupmsjAlerta').jqxWindow('close');

}