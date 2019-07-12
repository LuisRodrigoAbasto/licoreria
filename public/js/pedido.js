//mi url donde esta mi controlador
  const url_producto = window.location.protocol + '//' 
                    + window.location.host 
                    + '/zabol/controllers/ctrl_producto.php';

//mi url donde esta mi controlador pedido
  const url_pedido = window.location.protocol + '//' 
                    + window.location.host
                    + '/zabol/controllers/ctrl_pedido.php';


 var Item = "";// var que prepara datos para add al carrito

 //inicaliza el listado de producto cuando carga la pagina
 $(function () {
     get_producto();
 });


//  function addUbicacion(longitud, latitud, txtDir) {
//     //  txtLongitud.value = longitud;
//     //  txtLatitud.value = latitud;
//     var json = longitud;
//     var serverData=JSON.parse(json);
 }




 function agregar_acarrito() {
     /* if ($.trim($("#productName").val()) == "" || $.trim($("#price").val()) == "" || $.trim($("#quantity").val()) == "") return; */
     var params = Item;
     //console.log(params); 
     var productName = params.nombre_pro; //+' '+params.descrip,
     price = params.precio_pro;
         quantity = $("#quantity").val();
         detailsTableBody = $("#detailsTable tbody");

     var precioV = (parseFloat(price) * parseInt(quantity));
     var datos_item = params.id_producto + '*' + quantity + '*' + precioV;
     //item_prod (id_prod)
     console.log('DATOS AGREGADO ITEM' + datos_item);


     var all = '<br><input type="hidden" value="' + datos_item + '" name="dts_prod[]"/>';

     var x = '<br><input type="hidden" value="' + params.id_producto + '" name="item_prod[]"/>';
     var y = '<br><input type="hidden" value="' + quantity + '" name="item_cantidad[]"/>';
     var z = '<br><input type="hidden" value="' + precioV + '" name="item_subt[]"/>';

     var productItem = '<tr><td>' + productName + '</td><td>' + quantity + '</td><td>' + price + '</td><td>' + precioV + '</td><td><a data-itemId="0" href="#" class="deleteItem" style="color:#ff0c0c">X</a>'+ x + y + z + '</td></tr>';

     detailsTableBody.append(productItem);

     clearItem();
 }

 /* ELIMINAR ITEM CARRITO */
 $(document).on('click', 'a.deleteItem', function (e) {
     e.preventDefault();
     // var $self = $(this);
     if ($(this).attr('data-itemId') == "0") {
         $(this).parents('tr').css("background-color", "#ff6347").fadeOut(400, function () {
             $(this).remove();
         });
     }
 });
 /* ELIMINAR ITEM CARRITO */

 //Show Modal.
 function abrirModal(html, obj) {
     $("#newOrderModal").modal();
     console.log(html);
     console.log(obj);
     //carga los datos            
     $("#div_producto").html(html);
     Item = obj;
     $('#btn_modal_prod').html(
         '<button onclick="agregar_acarrito()" type="button" data-dismiss="modal" class="btn btn-danger">Agregar a Carrito</button>' +
         '<button type="button" onclick="clearItem()" class="btn btn-default" data-dismiss="modal">Close</button>');


 }

 function crear_tablaHTML(json) {
     var tabla = "";
     body = "";
     for (var i = 0; i < json.length; i++) {
         tabla += "<tr>";
         body = "<td>" + '<div class="row" ><div class="col-md-5" align="center" ><img src="img_producto.jpg" class="img-rounded img-responsive" width="100%"></div>'

             +
             '<div class="col-md-7" ><blockquote>' +
             '<dt>' + json[i].nombre_pro + '</dt>' +
             '<p>' + json[i].descripcion_pro + '</p>' +
             '<small class="pull-right" >' +
             'Precio: ' + json[i].precio_pro + ' bs.</small>' +
             '</blockquote></div>' +
             "</div></td>";
 
         tabla += body;
         body = JSON.stringify(body);

         var ln = JSON.stringify(json[i]);
         tabla += "<td><br><br><br><input onclick='abrirModal(" + body + "," + ln + ")' type='submit' name='boton' class='btn btn-warning btn3d' value='seleccionar'></td>";
         tabla += "</tr>";
     }

     $('#tabla_prod').html(tabla);
 }

 function get_producto() {

     $.ajax({        
         url: url_producto,         
         type: 'POST',
         data: 'boton=MOSTRAR_PRODUCTO',
         success: function (resp) {
             console.log(resp);
             var json = eval(resp);
             crear_tablaHTML(json);
         },
         error: function (err) {
             alert("Error!" + err);
         }
     });
}

function set_pedido(){
    var datos = $('#form_pedido_set').serialize();

    
    $.ajax({
         url:url_pedido,
        type:'POST',
        data: 'boton=GUARDAR_PEDIDO' + '&' + datos,
        success: function(resp){
          alert(resp);
          location.reload();
        },
      error: function(err){
          alert(err);
      }

    })
    
}

 //After Add A New Order In The List, Clear Clean The Form For Add More Order.
 function clearItem() {

     $("#quantity").val('');
     Item = "";
 }

