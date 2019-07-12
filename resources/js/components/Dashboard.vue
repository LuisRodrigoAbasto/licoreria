<template>
<main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
    </ol>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                
            </div>
            <div class="car-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Pedidos</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="pedidos">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Pedidos de los últimos meses.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h4>Ventas</h4>
                            </div>
                            <div class="card-content">
                                <div class="ct-chart">
                                    <canvas id="ventas">                                                
                                    </canvas>
                                </div>
                            </div>
                            <div class="card-footer">
                                <p>Ventas de los últimos meses.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
</template>

<script>
export default {
  data() {
    return {
    varPedido:null,
    charPedido:null,
    pedidos:[],
    varTotalPedido:[],
    varMesPedido:[],

    varVenta:null,
    charVenta:null,
    ventas:[],
    varTotalVenta:[],
    varMesVenta:[]
}
  },
  methods: {
    getPedidos(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.pedidos = respuesta.pedidos;
                    //cargamos los datos del chart
                    me.loadPedidos();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadPedidos(){
                let me=this;
                me.pedidos.map(function(x){
                    me.varMesPedido.push(x.mes);
                    me.varTotalPedido.push(x.total);
                });
                me.varPedido=document.getElementById('pedidos').getContext('2d');

                me.charPedido = new Chart(me.varPedido, {
                    type: 'bar',
                    data: {
                        labels: me.varMesPedido,
                        datasets: [{
                            label: 'Pedidos',
                            data: me.varTotalPedido,
                            backgroundColor: '#fd324e',
                            borderColor: '#fd324e',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
             getVentas(){
                let me=this;
                var url= '/dashboard';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.ventas = respuesta.ventas;
                    //cargamos los datos del chart
                    me.loadVentas();
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
              loadVentas(){
                let me=this;
                me.ventas.map(function(x){
                    me.varMesVenta.push(x.mes);
                    me.varTotalVenta.push(x.total);
                });
                me.varVenta=document.getElementById('ventas').getContext('2d');

                me.charVenta = new Chart(me.varVenta, {
                    type: 'bar',
                    data: {
                        labels: me.varMesVenta,
                        datasets: [{
                            label: 'Ventas',
                            data: me.varTotalVenta,
                            backgroundColor: '#FBF421',
                            borderColor: '#fd324e',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },         
        },
        mounted() {
            this.getVentas();
            this.getPedidos();
        }
    }
</script>