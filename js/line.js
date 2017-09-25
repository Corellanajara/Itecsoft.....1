$(document).ready(function() {

	//get canvas
	var ctx = $("#line-chartcanvas");

	$.ajax({
		url : "http://localhost:82/itecsoft/gentelella/production/data.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var sensor = {
				Humedad : [],
				Presion : [],
				Temperatura : []
			};

			var len = data.length;
			var dias=0;

			for (var i = 0; i < len; i++) {
				if (data[i].Id == "1") {
					sensor.Temperatura.push(data[i].Magnitud);
					
				}
				else if (data[i].Id == "2") {
					sensor.Presion.push(data[i].Magnitud);
					
				}
				else if(data[i].Id == "3"){
					sensor.Humedad.push(data[i].Magnitud);
					dias=dias+1;	
				}

			}
			var fechas = [];
			for (var i =1; i <= dias; i++) {
					var txt = " Dia ";
					fechas.push(txt.concat(i));
			}

			//get canvas
			var ctx = $("#line-chartcanvas");

			var data = {
				labels : fechas,
				datasets : [

					{
						label : "Humedad",
						data : sensor.Humedad,
						backgroundColor : "blue",
						borderColor : "lightblue",
						fill : false,
						lineTension : 0,
						pointRadius : 5
					},
					{
						label : "Presion",
						data : sensor.Presion,
						backgroundColor : "green",
						borderColor : "lightgreen",
						fill : false,
						lineTension : 0,
						pointRadius : 5
					},
					{
						label : "Temperatura",
						data : sensor.Temperatura,
						backgroundColor : "red",
						borderColor : "red",
						fill : false,
						lineTension : 0,
						pointRadius : 5
					}
				]
			};

	var options = {
		title : {
			display : true,
			position : "top",
			text : "Grafico de lineas",
			fontSize : 18,
			fontColor : "#111"
		},
		legend : {
			display : true,
			position : "bottom"
		}
	};

	var chart = new Chart( ctx, {
		type : "line",
		data : data,
		options : options
	} );
}
});	
});