<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="shortcut icon" href="https://res.cloudinary.com/crunchbase-production/image/upload/c_lpad,h_256,w_256,f_auto,q_auto:eco,dpr_1/v1408402010/bxqs0rvkbgqwgnnfnhu0.jpg">
    <title>Import Students</title>
    <style>
        body {
            background: url('images/blurred-smu-admin.jpg');
            background-size: cover;
            background-repeat: repeat-y;
        }
        table {
            background-color: #151c55;
            color: white;
            border: #151c55 solid 20px;
        }

        th,
        td {
            text-align: center;
        }

        .mail-link {
            color: white;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container" style="padding: 10px;">
        <div class="row center">
            <?php include 'templates/professor_nav.php' ?>
        </div>
    </div>
    <div class="container">
        <?php
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            };
        };
        ?>
        <div class="row center">
            <h4 class="center">Import Students</h4>
        </div>
    </div>
</body>

</html>