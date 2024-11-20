
 function CargarGrilla_routers(){
    //alert(url); 
    $("#jqxgrid_router").jqxGrid('clearselection'); 
     
    var url1 = urlservidor+"/Buscar";
    var source =
    {
        datatype: "json",
        datafields: [
            {name:'i_idservidor',type: 'string' },
            {name:'nodo',type: 'string' },   
            {name:'ip',type: 'string' }, 
            {name:'user',type: 'string' }, 
            {name:'pass',type: 'string' }, 
            {name:'ether',type: 'string' },  
            {name:'coordenadas',type: 'string'}, 
            {name:'version',type: 'string'},  
            {name:'redes',type: 'string'},  
            {name:'estado',type: 'string'},  
            {name:'port_web',type: 'string'},  
            {name:'trafico',type: 'string'}, 
            {name:'conexiones',type: 'string'}, 
            {name:'queues',type: 'string'}, 
            {name:'pcq',type: 'string'}, 
            {name:'hotspot',type: 'string'}, 
            {name:'binding',type: 'string'}, 
            {name:'arp',type: 'string'}, 
            {name:'pppoe',type: 'string'}, 
            {name:'dhcp',type: 'string'}, 
            {name:'fullcache',type: 'string'}, 
            {name:'facturaemail',type: 'string'}, 
            {name:'dias_facturaemail',type: 'string'}, 
            {name:'avisopantalla',type: 'string'}, 
            {name:'dias_avisopantalla',type: 'string'}, 
            {name:'corte',type: 'string'}, 
            {name:'dias_corte',type: 'string'}, 
            {name:'sms',type: 'string'}, 
            {name:'dias_sms',type: 'string'}, 
            {name:'bienvenida',type: 'string'}, 
            {name:'pagoemail',type: 'string'}, 
            {name:'modelo',type: 'string'}, 
            {name:'meses_corte',type: 'string'} 
        ], 
        data: {
            'cadena': $("#textoBusqueda").val() 
        },
        type:'POST',
        id: 'i_idservidor',
        url: url1,
        root: 'data'
    }; 
     
    $("#jqxgrid_router").jqxGrid(
    { 
        source: source,  
    });      
} 