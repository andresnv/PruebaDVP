/* globals Chart:false */

jQuery(document).ready(function() {	

    (() => {
      'use strict';

      // Graphs
      const ctx = document.getElementById('myChart');
      // eslint-disable-next-line no-unused-vars
      const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: grafica["lbls"],
          datasets: [{
            data: grafica["data"],
            lineTension: 0,
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            borderWidth: 1,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              boxPadding: 3
            }
          }
        }
      });
    })();

    jQuery("#btnBuscar").on("click", function(){
        vlrBuscar = jQuery("#txtBuscar").val().trim();
        if(vlrBuscar==''){
           error("Ingrese el criterio de búsqueda");
        }
        else if(vlrBuscar.length<4){
           error("Ingrese más de 4 caracteres");
        }
        else if(vlrBuscar=='doublevpartners'){
           error("Busqueda no permitida");
        }
        else{
            jQuery("#formBuscar").submit();
        }
    });
    
    
    jQuery('.btnAbrirInfo').on('click',function(){
        nomUser = jQuery(this).html();
        jQuery('.modal-body').load('infoUsuario.php?usuario='+nomUser,function(){
            jQuery('#myModal').modal({show:true});
        });
    });

});

function error(msjError){
    Tiempo = 3000;
    mTipo='danger';
    icon='fa-times-circle';
    
    jQuery.notify({        
        //icon: 'fa ' + icon,
        message: '<div class="text-center" style = "margin-top:-30px">'+msjError+'</div>'
    }, {

        type: mTipo,

        offset: {
            y: 80
        },
        delay: Tiempo,
        animate: {
            enter: 'animated zoomInDown',
            exit: 'animated zoomOutUp'
        },
        placement: {
            from: "top",
            align: "center"
        }
    });
}