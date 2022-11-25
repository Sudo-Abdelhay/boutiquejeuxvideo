<!--Fonction qui sera appelée pour afficher l'ensemble des jeux de la page d'acceuil-->

<?php function game_card($data){ ?>

    <div class="card" style="width: 16rem;">
        <img src="./ressources/images/games/<?php echo $data['image_path'] ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?php echo $data['titre'] ?></h5>
            <p><?php if (intval($data['prix'] == 0,00)){
                    echo 'GRATUIT';
                }else{
                    echo number_format($data['prix']/100,2,',',' ' )?>€<?php ;
                }
                ?></p>
            <a href="./detail_game.php?game_id=<?php echo $data['id'] ?>" class="btn btn-primary">Voir détail</a>
        </div>
    </div>



<?php } ?>



