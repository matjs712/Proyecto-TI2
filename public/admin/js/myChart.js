
$.ajax({
    url: "datos-graficos",
    type: "GET",
    dataType: "json",
    success: function (data) {
        console.log(data);
        labels = [];
        values = [];
        for(var i = 0; i < data.chart1.length; i++){
            labels.push(data.chart1[i]['name']);
            values.push(data.chart1[i]['cantidad']);
        }
        var backgroundColors = [];
        for (var i = 0; i < labels.length; i++) {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            backgroundColors.push(`rgba(${r}, ${g}, ${b}, 0.6)`);
        }

        const ctx = document.getElementById("myChart");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: " cantidad",
                        data: values,
                        borderColor: backgroundColors,
                        backgroundColor: backgroundColors,
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
       console.log(ingrediente);
        const ctx2 = document.getElementById("doughnutChart");


        new Chart(ctx2, {
            type: "pie",
            data: {
                labels: labels2,
                datasets: [
                    {
                        label: "ingredientes",
                        data: values2,
                        borderColor: 'white',
                        backgroundColor: backgroundColors,
                        borderWidth: 1.8,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                  legend: {
                    position: 'top',
                  },
                },
              },
        });
    },
    error: function(data){
        console.log(data);
    }
});