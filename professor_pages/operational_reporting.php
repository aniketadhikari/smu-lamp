<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/pages.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Operational Reporting</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
    <script type="text/javascript">
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                theme: "light1", // "light2", "dark1", "dark2"
                animationEnabled: false, // change to true		
                title: {
                    text: "Basic Column Chart"
                },
                data: [{
                    // Change type to "bar", "area", "spline", "pie",etc.
                    type: "column",
                    dataPoints: [{
                            label: "apple",
                            y: 10
                        },
                        {
                            label: "orange",
                            y: 15
                        },
                        {
                            label: "banana",
                            y: 25
                        },
                        {
                            label: "mango",
                            y: 30
                        },
                        {
                            label: "grape",
                            y: 28
                        }
                    ]
                }]
            });
            chart.render();

        }
    </script>
</head>


<body class="professor-body">
    <?php include '../templates/professor_nav.php'; ?>
    <div class="title" style="margin: 0px 0px 20px 0px">
        <h4 class="center" style="margin: 0px">Operational Reporting</h4>
    </div>
    <div  class="container" id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>

</html>