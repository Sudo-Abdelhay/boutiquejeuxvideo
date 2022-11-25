<?php

require 'config.php';
require 'game_card.php';
require './template/header.php';

$id = $_GET['id'];
global $connect;
$query = ' SELECT * FROM jeu
            INNER JOIN game_console ON jeu.id = game_console.jeu_id
            INNER JOIN console ON game_console.console_id = console.id
            WHERE console.id = ' . $id;

$stmt_filtred = mysqli_prepare($connect, $query);
mysqli_stmt_execute($stmt_filtred);
$filtred_result = mysqli_stmt_get_result($stmt_filtred);

?>
    <main>
    <section class="d-flex" style="gap: 1rem; flex-wrap: wrap; justify-content: center " >
<?php
while($data = mysqli_fetch_assoc($filtred_result)) {
    game_card($data);
} ?>
    <section>
    </main>





<?php require './template/footer.php';


