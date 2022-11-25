<!--Fichier qui va me servir a afficher la pade de detail d'un jeu lorsque l'on appuie sur voir détail-->

<?php
require './game_card.php';
require './config.php';
require './template/header.php';

$id = intval($_GET['game_id']);

global $connect;
// on crée la query
$query = 'SELECT 
            jeu.titre, 
            jeu.id, 
            jeu.description, 
            jeu.date_sortie, 
            jeu.image_path as jj, 
            restriction_age.label, 
            restriction_age.image_path, 
            note.note_media, 
            note.note_utilisateur
        FROM jeu
        INNER JOIN note ON jeu.note_id = note.id
        INNER JOIN restriction_age ON jeu.age_id = restriction_age.id 
        where jeu.id = ' . $id ;

// On prépare la requête
$stmt_detail = mysqli_prepare($connect, $query); // renvoi true ou false
// on execute la requête
mysqli_stmt_execute($stmt_detail);
// on récupère les résultats de la requête
$detail_result = mysqli_stmt_get_result($stmt_detail);
// on boucle les résultats
while($data = mysqli_fetch_assoc($detail_result)) {
    detail_game($data);
}



function detail_game($data){

?>

    <div class="card mb-3" style=" margin-left: 20%; margin-right: 20%; margin-top: 5rem">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="./ressources/images/games/<?php echo $data['jj'] ?>" class="card-img-top" style="height: 500px !important; object-fit: fill" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title" style="color: #0d6efd"><?php echo $data['titre']?></h5>
                    <?php label_detail($data['id']); ?>
                    <p class="card-text"><b>Synopsis: </b><?php echo $data['description']?></p>
                    <?php $date = date_create($data['date_sortie']);

                    $formateddate = date_format($date, 'd/m/Y'); ?>
                    <p class="card-text">Date de sortie: <b style="color: #0d6efd"><?php echo $formateddate ?></b> </p>
                    <div style="display: flex; align-items: center">
                        <img src="./ressources/images/pegi/<?php echo $data['image_path'] ?>" alt="pegi" style="height: 3rem">
                        <p style="margin: 0; padding-left: 0.5rem">age: <?php echo $data['label']?>+</p>
                    </div>
                    <div class="d-flex justify-content-around">
                        <p><i class="bi bi-star-fill" style="color: orange"></i> Avis presse <b style="color: #0d6efd"><?php echo $data['note_media']?></b>/20</p>
                        <p><i class="bi bi-star-fill" style="color: orange"></i> Avis utilisateur <b style="color: #0d6efd"><?php echo $data['note_utilisateur']?></b>/20</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php }

function label_detail($id){

    global $connect;

    $query2 =  'SELECT console.label
            from console
            inner join game_console as gc on console.id = gc.console_id
            inner join jeu on gc.jeu_id = jeu.id
            where jeu.id = ' . $id;

    $stmt_label = mysqli_prepare($connect, $query2);

    mysqli_stmt_execute($stmt_label);

    $label_result = mysqli_stmt_get_result($stmt_label);

    while($data2 = mysqli_fetch_assoc($label_result)) { ?>


        <span class="badge rounded-pill text-bg-primary"><?php echo $data2['label'] ?></span>

    <?php }

}?>


<?php require_once './template/footer.php';

