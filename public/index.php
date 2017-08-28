<!doctype html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700|Material+Icons' rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="site/fabulous.css">
	</head>
	<body>
		<div class="container">
			<a href="https://github.com/disastersystem">
				github
				<i class="material-icons">
					open_in_new
				</i>
			</a>
		</div>

		<script>
			window.addEventListener("deviceorientation", handleOrientation, true)

			function handleOrientation(event) {
				var absolute = event.absolute
				var alpha    = event.alpha
				var beta     = event.beta
				var gamma    = event.gamma

				// accelValuesX[index] = sensorEvent.values[0];
	   //          accelValuesY[index] = sensorEvent.values[1];
	   //          accelValuesZ[index] = sensorEvent.values[2];

				let rootSquare = Math.sqrt(
	            	Math.pow(alpha, 2) +
	            	Math.pow(beta, 2) +
	            	Math.pow(gamma, 2)
	            )

	            if (rootSquare < 2.0) {
		            console.log('dropped')
	            }
			}
		</script>
	</body>
</html>