<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TP PHP</title>
<!--    import bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <img src="../ressources/images/logo.png" alt="Logo">
    <nav class="d-flex border-bottom mx-2 "  style=" gap: 2px">
        <div class="">
            <div class="" aria-haspopup="true" aria-expanded="false">
                <a href="index.php" class="btn btn-primary">Tous les jeux</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Par console
            </button>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

            <?php
            global $connect;
            $query = ' SELECT console.label,console.id, COUNT(*) AS nombre_jeu
                                        FROM game_console
                                        INNER JOIN console ON console.id = game_console.console_id
                                        GROUP BY console_id ';
            $stmt_console = mysqli_prepare($connect, $query);
            mysqli_stmt_execute($stmt_console);
            $console_result = mysqli_stmt_get_result($stmt_console);
            ?>

            <?php
            while($data = mysqli_fetch_assoc($console_result)) {
                console_label($data);
            } ?>

                <?php function console_label($data){ ?>
                    <li><a class="dropdown-item btn btn-primary" href="../filtred_games.php?id=<?php echo $data['id']?>"><?php echo $data['label']?> (<?php echo $data['nombre_jeu']?>) </a></li>
                <?php } ?>

            <ul>

        </div>
    </nav>
</header>





