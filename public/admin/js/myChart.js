function GenerateBackgroundColor(labels){
    let backgroundColors = [];
    for (var i = 0; i < labels; i++) {
        var r = Math.floor(Math.random() * 255);
        var g = Math.floor(Math.random() * 255);
        var b = Math.floor(Math.random() * 255);
        backgroundColors.push(`rgba(${r}, ${g}, ${b}, 0.6)`);
    }
    return backgroundColors;
}
$.ajax({
    url: "datos-graficos",
    type: "GET",
    dataType: "json",
    success: function (data) {
        labels = [];
        values = [];
        for(var i = 0; i < data.chart1.length; i++){
            labels.push(data.chart1[i]['name']);
            values.push(data.chart1[i]['cantidad']);
        }
        const ctx = document.getElementById("myChart");
        let backgroundColor = GenerateBackgroundColor(labels.length);
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: " cantidad",
                        data: values,
                        borderColor: backgroundColor,
                        backgroundColor: backgroundColor,
                        borderWidth: 1,
                    },
                ],
            },
            options: {

                responsive: true,
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                                stepSize: (Math.ceil(Math.max.apply(null, values)/100)*100)/10,
                            },
                        },
                    ],
                },
            },
        });

        labels2 = [];
        ingrediente = [];
        values2 = [];
        for(var i = 0; i < data.chart1.length; i++){
            labels2.push(data.chart2[i]['proveedor']);
            ingrediente.push(data.chart2[i]['ingrediente']);
            values2.push(data.chart2[i]['cantidad']);
        }
    //    console.log(ingrediente);
    //     const ctx2 = document.getElementById("doughnutChart");
    //     let backgroundColor2 = GenerateBackgroundColor(labels2.length);


    //     new Chart(ctx2, {
    //         type: "pie",
    //         data: {
    //             labels: labels2,
    //             datasets: [
    //                 {
    //                     label: "ingredientes",
    //                     data: values2,
    //                     borderColor: backgroundColor2,
    //                     backgroundColor: backgroundColor2,
    //                     borderWidth: 1.8,
    //                 },
    //             ],
    //         },
    //         options: {
    //             responsive: true,

    //             legend: {
    //                 display: false,
    //             },
    //             scales: {
    //                 xAxes: [{
    //                     display: true,
    //                 }],
    //                 yAxes: [{
    //                     ticks:{
    //                         beginAtZero: true,

    //                     }
    //                 }],
    //             }
    //         }

    //     });
    },
    error: function(data){
        console.log(data);
    }
});
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
}),
//GRAFICO PRODUCTOS
$.ajax({
    method: 'GET',
    url:'/grafico-productos',
    success: function(response){
        // let usuariosNuevos = 0;
        let datos = [];
        let labels = [];
        JSON.parse(response).forEach(function(producto){
            datos.push(parseInt(producto.cantidad));
            labels.push(producto.nombre);
        });

        let canvas = document.getElementById('pieChart');
        let ctx = canvas.getContext('2d');
        let backgroundColor = GenerateBackgroundColor(labels.length);

        let data = {
            labels: labels,
            datasets: [{
                label: 'Cantidad',
                data: datos,
                borderColor: backgroundColor,
                backgroundColor: backgroundColor,
            }]
            };

            // Configura las opciones del gráfico
            var options = {
                responsive: true,

                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        display: true,
                    }],
                    yAxes: [{
                        ticks:{
                            beginAtZero: true,

                        }
                    }],
                }
            };

            // Crea el gráfico de líneas
            var lineChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
            });
        // $('.new-users').append($('<div>').addClass('bg-green rounded-pill w-25 text-center ml-auto').text(usuariosNuevos));

        // console.log('usuarios nuevos: ');
        console.log('grafico productos' + response);
    },
    error: function(response){
        console.log(response);
    }
})
//GRAFICO Ordenes
$.ajax({
    method: 'GET',
    url:'/grafico-ordenes',
    success: function(response){
        // let usuariosNuevos = 0;
        let labels = [];
        console.log(JSON.parse(response).Completado);
        let datos = [];
        const objeto = JSON.parse(response);

        Object.keys(objeto).forEach(function(key) {
        labels.push(key);
        datos.push(objeto[key]);
        });

        let canvas = document.getElementById('grafico-ordenes');
        let ctx = canvas.getContext('2d');
        let backgroundColor = GenerateBackgroundColor(labels.length);

        let data = {
            labels: labels,
            datasets: [{
                label: 'Cantidad',
                data: datos,
                borderColor: backgroundColor,
                backgroundColor: backgroundColor,
            }]
            };

            // Configura las opciones del gráfico
            var options = {
                responsive: true,

                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        display: true,
                    }],
                    yAxes: [{
                        ticks:{
                            beginAtZero: true,

                        }
                    }],
                }
            };

            // Crea el gráfico de líneas
            var lineChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
            });
        // $('.new-users').append($('<div>').addClass('bg-green rounded-pill w-25 text-center ml-auto').text(usuariosNuevos));

        // console.log('usuarios nuevos: ');
        console.log('grafico productos' + response);
    },
    error: function(response){
        console.log(response);
    }
})
$.ajax({
    method: 'GET',
    url:'/grafico-registros',
    success: function(response){
        // let usuariosNuevos = 0;
        let labels = [];
        let datos = [];

        JSON.parse(response).forEach(function(producto){
            datos.push(parseInt(producto.cantidad));
            labels.push(producto.proveedor + ': ' + producto.ingrediente);
        });
        let canvas = document.getElementById('doughnutChart');
        let ctx = canvas.getContext('2d');
        let backgroundColor = GenerateBackgroundColor(labels.length);

        let data = {
            labels: labels,
            datasets: [{
                label: 'Cantidad',
                data: datos,
                borderColor: backgroundColor,
                backgroundColor: backgroundColor,
            }]
            };

            // Configura las opciones del gráfico
            var options = {
                responsive: true,

                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        display: false,
                    }],
                    yAxes: [{
                        ticks:{
                            beginAtZero: true,

                        }
                    }],
                }
            };

            // Crea el gráfico de líneas
            var lineChart = new Chart(ctx, {
            type: 'polarArea',
            data: data,
            options: options
            });
        // $('.new-users').append($('<div>').addClass('bg-green rounded-pill w-25 text-center ml-auto').text(usuariosNuevos));

        // console.log('usuarios nuevos: ');
    },
    error: function(response){
        console.log(response);
    }
})
