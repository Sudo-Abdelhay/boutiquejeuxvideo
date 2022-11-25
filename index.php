<?php require 'config.php' ?>
<?php require_once './template/header.php'; ?>
<?php require_once 'game_card.php'?>

<!--ce fichier va servir a afficher les données de tous les jeux sur la page principale-->

<main>

    <section class="d-flex" style="gap: 1rem ; margin-bottom: 3rem ; flex-wrap: wrap; justify-content: center " >

    <?php

    // On se connecte a la BDD via le fichier config
    global $connect;

    // on selectionne tous les elements de la table jeu
    $query = "SELECT * FROM jeu";

    $stmt_games = mysqli_prepare($connect, $query);

    mysqli_stmt_execute($stmt_games);

    $games_result = mysqli_stmt_get_result($stmt_games);

    while($data = mysqli_fetch_assoc($games_result)) {
        game_card($data);

    } ?>

    </section>

</main>

<?php require_once './template/footer.php'; ?>


