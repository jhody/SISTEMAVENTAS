function iniciarGrillas(){ 
	var source =
    {
      datatype: "json",
        datafields: [
            {name:'c_idpersonal',type: 'string' },
            {name:'c_dni',type: 'string' },  
            {name:'n_traba_apepat',type: 'string' }, 
            {name:'n_traba_apemat',type: 'string' }, 
            {name:'n_traba_nombre1',type: 'string' }, 
            {name:'n_traba_nombre2',type: 'string' }, 
            {name:'c_traba_Sexo',type: 'string' }, 
            {name:'n_traba_direccion',type: 'string' }, 
            {name:'n_traba_email',type: 'string' }, 
            {name:'d_traba_fenac',type: 'string' }, 
            {name:'c_traba_sexo',type: 'string' }, 
            {name:'c_estciv_id',type: 'string' }, 
            {name:'c_pais',type: 'string' }, 
            {name:'c_depart',type: 'string' }, 
            {name:'c_provin',type: 'string' }, 
            {name:'c_distri',type: 'string' }, 
            {name:'n_usuario',type: 'string' }, 
            {name:'d_fechamodificacion',type: 'string' }, 
            {name:'estado_civil',type: 'string' }, 
            {name:'sexo',type: 'string' }, 
            {name:'departamento',type: 'string' }, 
            {name:'provincia',type: 'string' }, 
            {name:'distrito',type: 'string' },
            {name:'nombre_completo',type: 'string' },
            {name:'tiene_foto',type: 'string' }
        ],  
        type:'POST',
        id: 'c_idpersonal', 
        root: 'data'
    }; 
    var renderer = function (row, column, value) {
        return '<span style="margin-left: 4px; margin-top: 4px; float: left;">' + value + '</span>';
    }
    // creage jqxgrid
    $("#jqxgrid_personas").jqxGrid(
    {
        width: '99%',
        height: 440,
        theme: "ui-smoothness",
        source: source, 
        pageable: true,
        columnsresize: true, 
        columns: [ 
			{ text: 'Código',	 	    datafield: 'c_idpersonal',	    editable: false,hidden:false , width: '10%', cellsrenderer: renderer },
			{ text: 'DNI',	            datafield: 'c_dni',	            editable: false,hidden:false , width: '10%', cellsrenderer: renderer },  
            { text: 'Nombres',          datafield: 'nombre_completo',   editable: false,hidden:false , width: '40%', cellsrenderer: renderer },  
			{ text: 'n_traba_apepat',	datafield: 'n_traba_apepat',	editable: false,hidden:true , width: '00%', cellsrenderer: renderer },   
            { text: 'n_traba_apemat',   datafield: 'n_traba_apemat',    editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'n_traba_nombre1',  datafield: 'n_traba_nombre1',   editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'n_traba_nombre2',  datafield: 'n_traba_nombre2',   editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'c_traba_Sexo',     datafield: 'c_traba_Sexo',      editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'Dirección',        datafield: 'n_traba_direccion', editable: false,hidden:false , width: '50%', cellsrenderer: renderer }, 
            { text: 'Email',            datafield: 'n_traba_email',     editable: false,hidden:false , width: '50%', cellsrenderer: renderer }, 
            { text: 'Fecha Nac.',       datafield: 'd_traba_fenac',     editable: false,hidden:false , width: '50%', cellsrenderer: renderer }, 
            { text: 'c_estciv_id',      datafield: 'c_estciv_id',       editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'c_estciv_id',      datafield: 'c_pais',            editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'c_depart',         datafield: 'c_depart',          editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'c_provin',         datafield: 'c_provin',          editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'c_distri',         datafield: 'c_distri',          editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'Usuario q creo',   datafield: 'n_usuario',         editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
            { text: 'Fecha registro',   datafield: 'd_fechamodificacion', editable: false,hidden:false , width: '10%', cellsrenderer: renderer }, 
            { text: 'Estado civil',     datafield: 'estado_civil',      editable: false,hidden:false , width: '10%', cellsrenderer: renderer }, 
            { text: 'Sexo',             datafield: 'sexo',              editable: false,hidden:false , width: '10%', cellsrenderer: renderer }, 
            { text: 'Departamento',     datafield: 'departamento',      editable: false,hidden:false , width: '10%', cellsrenderer: renderer }, 
            { text: 'Provincia',        datafield: 'provincia',         editable: false,hidden:false , width: '10%', cellsrenderer: renderer }, 
            { text: 'Distrito',         datafield: 'distrito',          editable: false,hidden:false , width: '10%', cellsrenderer: renderer }, 
            { text: 'tiene_foto',       datafield: 'tiene_foto',      editable: false,hidden:true , width: '00%', cellsrenderer: renderer }, 
          ]
    });
	$("#jqxgrid_personas").on('rowselect', function (event) { 
        var data = $('#jqxgrid_personas').jqxGrid('getrowdata', event.args.rowindex);
          
        //$("#btnnuevo").attr("disabled","disabled") ;
        $("#idnombrepersonasel").html(data.nombre_completo);
        $("#idtxtdni").html("DNI : "+data.c_dni);
        $("#idtxtfechanac").html(data.d_traba_fenac);
        $("#idtxtestadocivil").html(data.estado_civil);
        $("#idtxtsexo").html(data.sexo);
        $("#idtxtubicacion").html(data.departamento+","+data.provincia+","+data.distrito);
        $("#idtxtemail").html(data.n_traba_email);
        if(data.tiene_foto=="1"){
            $("#idfotopersonasel").attr('src',ulrproj+"/index.php/Usuario/Verfoto/"+data.c_idpersonal);  
        } 
        if(data.tiene_foto=="0"){  
            $("#idfotopersonasel11").html('<img  id="idfotopersonasel" class="profile-user-img img-responsive img-circle" alt="User profile picture" src="'+ulrproj+'/images/avatar1.png">');
        }
        $("#btnnuevo").removeAttr("disabled") ;
        $("#btneditar").removeAttr("disabled") ;
        $("#btneliminar").removeAttr("disabled") ; 
    }); 
 }
 function fn_editar(){ 
    var rowindex = $('#jqxgrid_personas').jqxGrid('getselectedrowindex');  
    if(rowindex!=-1){ 
        $("#esNuevo").val("2"); 
        var data = $('#jqxgrid_personas').jqxGrid('getrowdata', rowindex); 
        $("#Personas_c_dni").attr("disabled","disabled") ;
        $("#Personas_c_idpersonal").val(data.c_idpersonal);
        $("#titulo_poput_mantenedor").html("Editar Persona - "+data.c_idpersonal);
        $("#Personas_c_dni").val(data.c_dni);
        $("#Personas_n_traba_apepat").val(data.n_traba_apepat);
        $("#Personas_n_traba_apemat").val(data.n_traba_apemat);
        $("#Personas_n_traba_nombre1").val(data.n_traba_nombre1);
        $("#Personas_n_traba_nombre2").val(data.n_traba_nombre2); 
        $("#Personas_c_traba_sexo").val(data.c_traba_sexo);
        $("#Personas_n_traba_direccion").val(data.n_traba_direccion);
        $("#Personas_n_traba_email").val(data.n_traba_email);
        $("#Personas_d_traba_fenac").val(data.d_traba_fenac);
        $("#Personas_c_estciv_id").val(data.c_estciv_id);
        $("#Personas_c_depart").val(data.c_depart).change();
        $("#Personas_c_provin").val(data.c_provin);
        $("#Personas_c_distri").val(data.c_distri);
        $("#popup_mantenedor").jqxWindow('open'); 
        $("#imgvalidate_username").css("display","none");
        $('#dtpfechanac ').jqxDateTimeInput('setDate', new Date(data.d_traba_fenac));
        $("#Personas_n_traba_apepat").focus();
        $("#file-preview").attr("src",$("#idfotopersonasel").attr("src")); 
    }else{
 
        fn_mostrar_msj("ico_alerta.jpg","Seleccione una fila de la tabla para modificar","#jqxgrid_personas",'fn_cerrar_poput_msjs()',"Aceptar");
        var offset = $("#jqxgrid_personas").offset();  
        $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
        position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 
          $("#btncancelarMsj").css("display","none");
        $("#btnaceptarMsj").focus();
    } 
 

}
  function CargarGrilla_personas(){
    //alert(url); 
    var url1 = urlpersonas+"/Buscar";
    var source =
    {
        datatype: "json",
        datafields: [
            {name:'c_idpersonal',type: 'string' },
            {name:'c_dni',type: 'string' },  
            {name:'n_traba_apepat',type: 'string' }, 
            {name:'n_traba_apemat',type: 'string' }, 
            {name:'n_traba_nombre1',type: 'string' }, 
            {name:'n_traba_nombre2',type: 'string' }, 
            {name:'c_traba_Sexo',type: 'string' }, 
            {name:'n_traba_direccion',type: 'string' }, 
            {name:'n_traba_email',type: 'string' }, 
            {name:'d_traba_fenac',type: 'string' }, 
            {name:'c_traba_sexo',type: 'string' }, 
            {name:'c_estciv_id',type: 'string' }, 
            {name:'c_pais',type: 'string' }, 
            {name:'c_depart',type: 'string' }, 
            {name:'c_provin',type: 'string' }, 
            {name:'c_distri',type: 'string' }, 
            {name:'n_usuario',type: 'string' }, 
            {name:'d_fechamodificacion',type: 'string' }, 
            {name:'estado_civil',type: 'string' }, 
            {name:'sexo',type: 'string' }, 
            {name:'departamento',type: 'string' }, 
            {name:'provincia',type: 'string' }, 
            {name:'distrito',type: 'string' },
            {name:'nombre_completo',type: 'string' },
            {name:'tiene_foto',type: 'string' }
        ], 
        data: {
            'cadena': $("#textoBusqueda").val() 
        },
        type:'POST',
        id: 'c_idpersonal',
        url: url1,
        root: 'data'
    }; 
     
    $("#jqxgrid_personas").jqxGrid(
    { 
        source: source,  
    });      
}

function fn_eliminar(){
    var rowindex = $('#jqxgrid_personas').jqxGrid('getselectedrowindex');  

      if(rowindex!=-1){
          
            var data = $('#jqxgrid_personas').jqxGrid('getrowdata', rowindex); 
          $("#popupmsjAlerta").jqxWindow({  width: 300,height:110});
          fn_mostrar_msj("ico_pregunta.jpg","¿Desea eliminar la persona seleccionada?","#jqxgrid_personas","fn_eliminar_persona('"+data.c_idpersonal+"')","Continuar");
          var offset = $("#jqxgrid_personas").offset();  
        $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
          position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 

          $("#btnsalirMsj").css("display","inline");
          $("#btnaceptarmsj").focus();
      }else{ 
            fn_mostrar_msj("ico_alerta.jpg","Seleccione una fila de la tabla para eliminar","#jqxgrid_personas",'fn_cerrar_poput_msjs()',"Aceptar");
            var offset = $("#jqxgrid_personas").offset();  
            $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
            position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 
          $("#btncancelarMsj").css("display","none");
            $("#btnaceptarMsj").focus();
      } 
}
function fn_eliminar_persona(id){ 
         fn_cerrar_ventana_msjs_menu();
        var url1 = urlpersonas+"/Eliminar";
        $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  {c_idpersonal:id} ,  
            beforeSend: function() {   
                $("#cargandopersonas").css("display", "inline");
                $("#btnguardar_rol").attr("disabled","disabled") ;
                $("#btncancelar_rol").attr("disabled","disabled") ;
              },
            success: function(arreglo){  
                $("#btnguardar_rol").removeAttr("disabled"); 
                $("#btncancelar_rol").removeAttr("disabled");  
                $("#msjnotifrol").html(arreglo.msj);
                $("#cargandopersonas").css("display", "none"); 
                if(arreglo.error=="0"){
                    fn_notificacion_general("success","Aviso","Persona eliminada","","");
                    CargarGrilla_personas();
                    $("#popup_mantenedor").jqxWindow('close'); 
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,arreglo.info,arreglo.msj_detalle); 
                } 
            },
            error: function(xhr){    
                $("#cargandopersonas").css("display", "none"); 
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
      });
}
function fn_nuevo(){
        //$("#btngenerarid").css("display","inline");
    //$("#esNuevo").val("1");
    $("#Personas_c_dni").removeAttr("disabled") ; 
    $("#titulo_poput_mantenedor").html("Nuevo Personal");
    $("#popup_mantenedor").jqxWindow('open'); 
    $("#Personas_c_dni").focus();
    $("#Personas_c_idpersonal").val(""); 
    $("#Personas_c_dni").val("");
    $("#Personas_n_traba_apepat").val("");
    $("#Personas_n_traba_apemat").val("");
    $("#Personas_n_traba_nombre1").val("");
    $("#Personas_n_traba_nombre2").val(""); 
    $("#Personas_c_traba_sexo").val("M");
    $("#Personas_n_traba_direccion").val("");
    $("#Personas_n_traba_email").val("");
    $("#Personas_d_traba_fenac").val("");
    $("#Personas_c_estciv_id").val("");
    $("#Personas_c_depart").val("13");
    $("#Personas_c_provin").val("01");
    $("#Personas_c_distri").val("01");
          $("#imgvalidate_username").css("display","none");
          $("#inputdtpfechanac").css("display","inline");
    $('#dtpfechanac ').jqxDateTimeInput('setDate', new Date());
    var today = new Date(); 
                var dd = today.getDate();
                var mm = today.getMonth()+1; //January is 0!

                var yyyy = today.getFullYear();
                if(dd<10){
                    dd='0'+dd
                } 
                if(mm<10){
                    mm='0'+mm
                } 
                var today = yyyy+'-'+mm+'-'+dd;

                $("#Personas_d_traba_fenac").val(today);

    fn_generarid();

    //cargarProvincias($('#Personas_c_depart').find('option:selected').val());
    $("#titulo_poput_mantenedor").html("Nuevo Personal - Código :"+$("#Personas_c_idpersonal").val());
}
function fn_cancelar(){

    $("#popup_mantenedor").jqxWindow('close'); 
}
function fn_guardar(){
    var check = $('#personas-form').jqxValidator('validate');
    if(check == true){
        var url1 = urlpersonas+"/Guardar";
        var msjjj ="Persona Creada"
        if($("#esNuevo").val()=="2"){  
             url1=urlpersonas+"/Guardar";
            msjjj ="Persona actualizada"
        } 
        var formData = new FormData(document.forms.namedItem("personas-form")); 
        $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  formData , 
            cache:false,
            contentType: false,
            processData: false,
            beforeSend: function(){   
                $("#cargando").css("display", "inline");
                $("#btnguardar_persona").attr("disabled","disabled") ;
                $("#btncancelar_persona").attr("disabled","disabled") ;
              },
            success: function(arreglo){  
                $("#btnguardar_persona").removeAttr("disabled"); 
                $("#btncancelar_persona").removeAttr("disabled");   
                $("#cargando").css("display", "none"); 
                if(arreglo.error=="0"){ 
                    fn_notificacion_general("success","Aviso",msjjj,"","");
                    CargarGrilla_personas();
                    $("#popup_mantenedor").jqxWindow('close'); 
                }
                if(arreglo.error=="1"){
                    fn_notificacion_general("error","Aviso",arreglo.msj,"",arreglo.info); 
                } 
            },
            error: function(xhr){   
                fn_cerrar_ventana_msjs_menu();
                $("#cargando").css("display", "none");  
                $("#btnguardar_persona").removeAttr("disabled") ; 
                $("#btncancelar_persona").removeAttr("disabled") ;   
                fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
        });
    }else{
        fn_mostrar_msj("ico_alerta.jpg","Verifique los errores del formulario","#Personas_c_traba_sexo",'fn_cerrar_poput_msjs()',"Aceptar");
        var offset = $("#Personas_c_traba_sexo").offset();  
        $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
        position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 
          $("#btncancelarMsj").css("display","none");
        $("#btnaceptarMsj").focus();
    }
}
function fn_generarid(){
    var url1 = urlpersonas+"/Generar_id";
    $.ajax({
            type: "POST",
            url:  url1,
            cache:false,
                contentType: false,
                processData: false,
            beforeSend: function() {   
                $("#Personas_c_idpersonal").val("");
                //$("#cargando_generar_id").css("display", "inline");
              },
            success: function(nuevoid){  
                //$("#cargando_generar_id").css("display", "none"); 
                $("#Personas_c_idpersonal").val(nuevoid);
                $("#titulo_poput_mantenedor").html("Nuevo Personal - Código gen.: "+nuevoid);
            },
            error: function(xhr){
              //$("#cargando_generar_id").css("display", "none");
                
            }
      });
}
function fn_validar_dni_persona(){
    var url1 = urlpersonas+"/validar_dni";
    if($("#Personas_c_dni").val().trim()==""){
        $("#imgvalidate_username").html('<img align="absmiddle" style="display:inline;height:15px" src="'+ulrproj+'/images/ico_error.jpg"/>');   
        $("#imgvalidate_username").css("display", "inline"); 
        return;
    }
    $.ajax({
            type: "POST",
            url:  url1,
            dataType: 'json', 
            data:  {c_dni:$("#Personas_c_dni").val()} ,  
            beforeSend: function() {   
                $("#imgvalidate_cargando").css("display", "inline");
                $("#imgvalidate_username").css("display", "none");
                $("#Usuario_n_username").attr("disabled","disabled") ; 
              },
            success: function(arreglo){  
                $("#Usuario_n_username").removeAttr("disabled");    
                $("#imgvalidate_cargando").css("display", "none"); 
                if(arreglo.error=="0"){ 
                    $("#imgvalidate_username").html('<img align="absmiddle" style="display:inline;height:15px" src="'+ulrproj+'/images/ico_aceptar.png"/>');   
                    $("#imgvalidate_username").css("display", "inline");  
                }
                if(arreglo.error=="1"){
                    //fn_notificacion_general("error","Aviso",arreglo.msj,"",arreglo.info); 
                    $("#imgvalidate_username").html('<img align="absmiddle" style="display:inline;height:15px" src="'+ulrproj+'/images/ico_error.jpg"/>');   
                    $("#imgvalidate_username").css("display", "inline"); 
                } 
            },
            error: function(xhr){   
                fn_cerrar_ventana_msjs_menu();
                $("#imgvalidate_cargando").css("display", "none");  
                $("#Usuario_n_username").removeAttr("disabled") ;  
                $("#imgvalidate_username").html('<img align="absmiddle" style="display:inline;height:15px" src="'+ulrproj+'/images/ico_error.jpg"/>');   
                $("#imgvalidate_username").css("display", "inline"); 
                //fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
            }
        });
}
function fn_VerReporte_listado_personas()
  {
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("target", "formresult");
        form.action = ulrproj+"/index.php/Personas/Rpte_lista_personas";
        var hiddenField = document.createElement("input"); 
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", "cadena");
        hiddenField.setAttribute("value", $('#textoBusqueda').val());
        form.appendChild(hiddenField);
        document.body.appendChild(form);

        var w = 700;
        var h = 600;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        javascript:window.open(ulrproj+"/index.php/Personas/Rpte_lista_personas","formresult","width="+w+",height="+h+",top="+top+",left="+left); 
        form.submit();
  }
  function fn_VerReporte_ver_persona()
  {
        var rowindex = $('#jqxgrid_personas').jqxGrid('getselectedrowindex');  
      if(rowindex!=-1){
          
            var data = $('#jqxgrid_personas').jqxGrid('getrowdata', rowindex); 
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("target", "formresult");
            form.action = ulrproj+"/index.php/Personas/Rpte_ver_persona";
            var hiddenField = document.createElement("input"); 
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", "idpers");
            hiddenField.setAttribute("value", data.c_idpersonal);
            form.appendChild(hiddenField);
            document.body.appendChild(form);

            var w = 700;
            var h = 600;
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            javascript:window.open("","formresult","width="+w+",height="+h+",top="+top+",left="+left); 
            form.submit();
      }else{ 
            fn_mostrar_msj("ico_alerta.jpg","Seleccione una fila de la tabla para eliminar","#jqxgrid_personas",'fn_cerrar_poput_msjs()',"Aceptar");
            var offset = $("#jqxgrid_personas").offset();  
            $("#popupmsjAlerta").jqxWindow({cancelButton: $("#btnsalirMsj"),theme: "ui-smoothness",
            position: { x: parseInt(offset.left) + 10, y: parseInt(offset.top) + 10 }} ); 
          $("#btncancelarMsj").css("display","none");
            $("#btnaceptarMsj").focus();
      } 
  }