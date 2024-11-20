@extends('layouts.app')

@section('title', 'Página Principal')

@section('content')
    <!-- Tu contenido aquí -->
  <div class="row">
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua" style="background-color: #87cbdb !important;">
                  <div class="inner">
                    <h3 class="total_ventas_dia">S/0</h3>
                    <p>Ventas</p>
                  </div>
                  <div class="icon" style="margin-top:15px">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <a href="{{ route('venta.index') }}" class="small-box-footer">
                    M&aacute;s Info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green" style="background-color: #f06767 !important;">
                  <div class="inner">
                    <h3 class="cantidad_pedidos_dia">0<sup style="font-size: 20px"></sup></h3>
                    <p>Compras</p>
                  </div>
                  <div class="icon" style="margin-top:15px">
                    <i class="fa fa-truck"></i>
                  </div>
                  <a href="{{ route('compra.index') }}" class="small-box-footer">
                    M&aacute;s Info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-yellow" style="background-color: #7973d1 !important;box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12)"  id="idcabyhleonf1c3">
                  <div class="inner">
                    <h3>0</h3>
                    <p>N&#176; de Clientes</p>
                  </div>
                  <div class="icon" style="margin-top:15px">
                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                  </div>
                  <a href="{{ route('cliente.index') }}" class="small-box-footer">
                      <div style="margin-left:5px;" class="pull-left">

                      </div>
                      <div style="margin-right:5px;" class="pull-right">
                          M&aacute;s Info <i class="fa fa-arrow-circle-right"></i>
                      </div>
                      .
                  </a>
                </div>
              </div><!-- /.col -->
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="small-box bg-red" style="background-color: #49bfc5 !important;box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12)"  id="idcabyhleonf1c4">
                  <div class="inner">
                    <h3 class="cantidad_productos">0</h3>
                    <p>Productos registrados</p>
                  </div>
                  <div class="icon">
                    <i style="margin-top:20px" class="fa fa-cubes" aria-hidden="true"></i>
                  </div>
                  <a href="{{ route('producto.index') }}" class="small-box-footer">

                    M&aacute;s info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div><!-- /.col -->
            </div>

      <div>
          <div class="box box-warning" style="box-shadow:0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12)">
              <div class="box-body ">
                  <div class="row">
                    <div class="col-sm-12" style="text-align:center;">
                      <div style="height:35px;">
                    <h3 class="breadcrumb" style="margin-bottom: 10px;">Ventas de productos por mes S/</h3>
                          <div class="col-md-5">
                              <div class="pull-left" role="group">
                                  <div class="form-group input-group-sm m-form__group" style="padding:0;">
                                      <select id="jqxTree_years" class="jqxTree_years form-control" onchange='fn_cargar_lista()'>

                                      </select>
                                  </div>
                              </div>
                              <div class="pull-left form-group input-group-sm m-form__group">
                                  &nbsp;&nbsp;<button onmousemove="fn_asignar_tooltip(this,'top')" msj-yhody="Editar" type="button" style="color:green;margin-top:-4px" onclick="cargarGrafico();" class="btn btn-sm btn-default command-edit" data-row-id="1" data-toggle="tooltip" data-placement="top" data-original-title="Actualizar Gr&aacute;fico" id="jqxWidget07e5e267"><span class="fa fa-refresh" style="margin-top:-2px"></span></button>
                              </div>
                              <div class="pull-left">
                                  &nbsp;&nbsp;<button onmousemove="fn_asignar_tooltip(this,'top')" msj-yhody="Editar" type="button" style="color:green;margin-top:-4px;display:none;" onclick="fn_imprimir_grafico();" class="btn btn-sm btn-default command-edit" data-row-id="1" data-toggle="tooltip" data-placement="top" data-original-title="Imprimir"  id="jqxWidget07e5e267"><span class="fa fa-print" style="margin-top:-2px"></span></button>
                              </div>
                          </div>
                          <div class="col-md-7">
                              <div id='eventText' class="pull-right" style="width:600px; height: 30px"/>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12" id="chartContainer11">
                      <div class="chart">
                          <canvas id="barChart" style="height:400px"></canvas>
                      </div>

                  </div>
              </div>
          </div>
      </div>

  <script type="text/javascript">

      var MouseensimaGrafico=0;
      var maxValor=100;
      var id_graf ;
      var year_y=2012;
      var mes_y=12;
      var altopantalla = screen.height;
      $(document).ready(function (){
          //alert("dsds");

            $(".menu_inicio").addClass("active");
            $(".menu_inicio a").append(`<span style="color:yellow;" class=" pull-right"><i class="fa fa-check" aria-hidden="true"></i></span>`);


          var dropDownContent = '<div style="position: relative; margin-left: 3px; margin-top: 1px;">Seleccionar A&ntilde;o</div>';

          $("#chartContainer11").css("height",altopantalla-490);
          $("#idsidebar_toggle_barra_titulo").append('<button type="button" id="btnguardar_usuario" onclick="fn_cambiar_vista('+"'<?php echo $modo;?>'"+');" class="btn btn-default submitx"><i class="fa fa-eye"></i> Cambiar a vista cliente</button>');
          fn_cargar_years_de_facturas();

          <?php echo date_default_timezone_set('America/Lima'); ?>;
          var year_actual=<?php echo date("Y"); ?>;
          year_y=year_actual;
          var mes_actual=<?php echo date("m"); ?>;
          mes_y=mes_actual;
          var meses =[];
          if(mes_actual==1){
              meses = ["ENERO"];
          }
          if(mes_actual==2){
              meses =  ["ENERO", "FEBRERO"];
          }
          if(mes_actual==3){
              meses = ["ENERO", "FEBRERO", "MARZO"];
          }
          if(mes_actual==4){
              meses = ["ENERO", "FEBRERO", "MARZO", "ABRIL"];
          }
          if(mes_actual==5){
              meses =  ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO"];
          }
          if(mes_actual==6){
              meses =  ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO"];
          }
          if(mes_actual==7){
              meses =  ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO"];
          }
          if(mes_actual==8){
              meses =  ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO"];
          }
          if(mes_actual==9){
              meses =  ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE"];
          }
          if(mes_actual==10){
              meses =  ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE"];
          }
          if(mes_actual==11){
              meses =  ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE"];
          }
          if(mes_actual==12){
              meses =  ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];
          }


          id_graf=setInterval("fn_actualizar_graf()",3000);

          fn_cargar_datos_cabecera_sistema();

      });
      var yaingresograf=0;
      function fn_actualizar_graf(){
          yaingresograf=1;
          if(yaingresograf==1){
              window.clearInterval(id_graf);
          }
          cargarGrafico();
      }
      var yearsel="";
      function fn_cargar_years_de_facturas(){
          var url1 = "/cargar-years-de-ordenes";
          $.ajax({
              type: "GET",
              url:  url1,
              dataType: 'json',
              data: {cadena:''},
              beforeSend: function() {
                },
              success: function(arreglo){
                  var vvv='';
                  for(var p in arreglo)   {
                      vvv+='<option value="'+arreglo[p]["id"]+'">'+arreglo[p]["id"]+'</option>';
                  }
                  $('#jqxTree_years').html(vvv);

              },
              error: function(xhr){
                  fn_notificacion_general("error","Aviso","Ocurrio un error al activar","click aqui para ver detalle",xhr.responseText);
              }
          });
      }
      function fn_cambiar_vista(modo){


          var form = document.createElement("form");
                  form.setAttribute("method", "post");
                  form.action = "/index.php/Site/index";
                  var hiddenField = document.createElement("input");
                  hiddenField.setAttribute("type", "hidden");
                  hiddenField.setAttribute("name", "modo");
                  hiddenField.setAttribute("value", modo);
                  form.appendChild(hiddenField);

                  document.body.appendChild(form);

                  form.submit();
      }
      function cargarGrafico(){

                  $.ajax({
                      url:  "/ver-json-grafico-ingresos-meses",
                      data: {
                          anio:yearsel
                      },
                      dataType: 'json',
                      type: 'get',
                      beforeSend: function() {

                      },
                      success: function(data)
                      {
                          var labels=[];
                          var datos=[];
                          for(var p in data){
                              labels[labels.length]=data[p]["mes"];
                              datos[datos.length]=data[p]["total"];
                          }
                          var areaChartData = {
                            labels: labels,
                            datasets: [
                              {
                                label: "Digital Goods",
                                fillColor: "rgba(60,141,188,0.9)",
                                strokeColor: "rgba(60,141,188,0.8)",
                                pointColor: "#3b8bba",
                                pointStrokeColor: "rgba(60,141,188,1)",
                                pointHighlightFill: "#fff",
                                pointHighlightStroke: "rgba(60,141,188,1)",
                                data: datos
                              }
                            ]
                          };
                          //-------------
                          //- BAR CHART -
                          //-------------
                          var barChartCanvas = $("#barChart").get(0).getContext("2d");
                          var barChart = new Chart(barChartCanvas);
                          var barChartData = areaChartData;
                          barChartData.datasets[0].fillColor = "#cdca64";
                          barChartData.datasets[0].strokeColor = "#cdca64";
                          barChartData.datasets[0].pointColor = "#1971b0";
                          var barChartOptions = {
                            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                            scaleBeginAtZero: true,
                            //Boolean - Whether grid lines are shown across the chart
                            scaleShowGridLines: true,
                            //String - Colour of the grid lines
                            scaleGridLineColor: "rgba(0,0,0,.05)",
                            //Number - Width of the grid lines
                            scaleGridLineWidth: 1,
                            //Boolean - Whether to show horizontal lines (except X axis)
                            scaleShowHorizontalLines: true,
                            //Boolean - Whether to show vertical lines (except Y axis)
                            scaleShowVerticalLines: true,
                            //Boolean - If there is a stroke on each bar
                            barShowStroke: true,
                            //Number - Pixel width of the bar stroke
                            barStrokeWidth: 2,
                            //Number - Spacing between each of the X value sets
                            barValueSpacing: 5,
                            //Number - Spacing between data sets within X values
                            barDatasetSpacing: 1,
                            //String - A legend template
                            legendTemplate: "",
                            //Boolean - whether to make the chart responsive
                            responsive: true,
                            maintainAspectRatio: true
                          };

                          barChartOptions.datasetFill = false;
                          barChart.Bar(barChartData, barChartOptions);

                      },
                      error: function(xhr){
                          fn_notificacion_general("error","Aviso","Ocurrio un error con el servidor","click aqui para ver detalle",xhr.responseText);
                      }
                  });


      }

      function fn_cargar_datos_cabecera_sistema(){


          $.ajax({
                  type: "GET",
                  url:    "/cargar-datos-cabecera-sistema",
                  dataType: 'json',
                  data:{
                      year:year_y,
                      mes:mes_y
                  },
                  beforeSend: function() {
                      $("#idcabyhleonf1c1").find(".info-box-number").html('<i class="fa fa-refresh fa-spin"></i>');
                      $("#idcabyhleonf1c1").find(".progress-description").find("button").html('<i class="fa fa-refresh fa-spin"></i>');
                      $("#idcabyhleonf1c2").find(".info-box-content").find("span:nth-child(2)").html('<i class="fa fa-refresh fa-spin"></i>');
                      $("#idcabyhleonf1c2").find(".info-box-content").find("span:nth-child(3)").html('<i class="fa fa-refresh fa-spin"></i>');
                      $("#idcabyhleonf1c3").find("div:nth-child(1)").find("h3").html('<i class="fa fa-refresh fa-spin"></i>');
                      $("#idcabyhleonf1c4").find("div:nth-child(1)").find("h3").html('<i class="fa fa-refresh fa-spin"></i>');
                  },
                  success: function(data){
                      $(".total_ventas_dia").html(' S/'+data.total_ventas_dia);
                      $(".cantidad_pedidos_dia").html(data.cantidad_pedidos_dia);
                      $(".cantidad_productos").html(data.cantidad_productos);

                      $("#idcabyhleonf1c3").find("div:nth-child(1)").find("h3").html(data.cantidad_clientes);

                      $("#idcabyhleonf1c3").find(".small-box-footer").find("div:nth-child(1)").html(data.cantidad_clientes_anulados+'<span data-toggle="tooltip" data-placement="top" title="anulados" class="glyphicon glyphicon-trash" style="margin-left:5px;"></span>&nbsp&nbsp&nbsp&nbsp'+data.cantidad_clientes_inactivos+'&nbsp<i class="fa fa-user-times" data-toggle="tooltip" data-placement="top" title="inactivos"></i>&nbsp&nbsp&nbsp&nbsp'+data.cantidad_clientes_activos+'&nbsp<i class="fa fa-user" data-toggle="tooltip" data-placement="top" title="activos"></i>');


                  },
                  error: function(xhr){
                      $("#idcabyhleonf1c1").find(".info-box-number").html('<i class="fa fa-warning" data-toggle="tooltip" data-placement="top" title="Error al cargar"></i>');
                      $("#idcabyhleonf1c1").find(".progress-description").find("button").html('<i class="fa fa-warning" data-toggle="tooltip" data-placement="top" title="Error al cargar"></i>&nbspError');
                      $("#idcabyhleonf1c2").find(".info-box-content").find("span:nth-child(2)").html('<i class="fa fa-warning" data-toggle="tooltip" data-placement="top" title="Error al cargar"></i>&nbspError');
                      $("#idcabyhleonf1c2").find(".info-box-content").find("span:nth-child(3)").html('<i class="fa fa-warning" data-toggle="tooltip" data-placement="top" title="Error al cargar"></i>&nbspError');
                      $("#idcabyhleonf1c3").find("div:nth-child(1)").find("h3").html('<i class="fa fa-warning" data-toggle="tooltip" data-placement="top" title="Error al cargar"></i>&nbspError');
                      $("#idcabyhleonf1c4").find("div:nth-child(1)").find("h3").html('<i class="fa fa-warning" data-toggle="tooltip" data-placement="top" title="Error al cargar"></i>&nbspError');
                  }
              });
      }
      function fn_imprimir_grafico(){
          var content = $('#chartContainer11')[0].outerHTML;
                      var newWindow = window.open('', '', 'width=800, height=500'),
                      document = newWindow.document.open(),
                      pageContent =
                          '<!DOCTYPE html>' +
                          '<html>' +
                          '<head>' +
                          '<meta charset="utf-8" />' +
                          '<title>Reporte de Pagos Cobrados y por Cobrar</title>' +
                          '<style type="text/css" media="print">@page { size: landscape; }</style>'+
                          '</head>' +
                          '<body>' + content + '</body></html>';
                      try
                      {
                          document.write(pageContent);
                          document.close();
                          newWindow.print();
                          newWindow.close();
                      }
                      catch (error) {
                      }
      }
    </script>
@endsection
