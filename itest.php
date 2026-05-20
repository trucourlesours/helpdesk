<?php 
    
        $serveur = 'localhost';
		$dbname = 'jeux_video';
		$login = 'root';
		$mdp = '';

		$link = mysqli_connect($serveur,$login,$mdp,$dbname);

        if(!$link){
			die("La connexion a échoué: " .mysqli_connect_error());
		}


        //ajout de jeu

        if(isset($_POST['mon_ajout'])){
            $sql_ajout ="insert into jeux(titre,annee_sortie,note,studio_id,genre_id) values (?,?,?,?,?)";
            $stmt_ajout = mysqli_prepare($link,$sql_ajout);
            mysqli_stmt_bind_param($stmt_ajout,"siiii",
            $_POST['titre'],$_POST['annee'],$_POST['note_insert'],$_POST['studio_insert'],$_POST['genre_insert']);
            mysqli_stmt_execute($stmt_ajout);
            }
        // query pour le select

        $stmt_select = mysqli_prepare($link,"select * from genres");
        mysqli_stmt_execute($stmt_select);

        $res_select = mysqli_stmt_get_result($stmt_select);

        //filtre
        $filtre_genre ="";
        $filtre_note ="";
        if(isset($_POST['mon_filtre'])){
            if(!empty($_POST['genre'])){
                $filtre_genre =  "where genre_id = ".$_POST['genre'];
            }
            if(isset($_POST['note']) && $_POST['note']<>"all"){
                switch($_POST['note']){
                    case '10':$filtre_note ="note<10";break;
                    case '15':$filtre_note ="note>10 and note<15";break;
                    case '20':$filtre_note ="note>15 and note<20";break;
                }
                if(!empty($_POST['genre'])){
                    $filtre_note = " and ".$filtre_note;
                }
                else{
                    $filtre_note = " where ".$filtre_note;
                }
            }

        }
        

        //query pour les jeux vidéo

        $sql_jeux="
        select * from jeux
        inner join genres on jeux.genre_id = genres.id 
        inner join studios on jeux.studio_id = studios.id ".$filtre_genre.$filtre_note;

        //print($sql_jeux);

        $stmt_jeux = mysqli_prepare($link,$sql_jeux);
        mysqli_stmt_execute($stmt_jeux);

        $res_jeux = mysqli_stmt_get_result($stmt_jeux);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Jeux vidéo</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Bibliothèque Jeux Vidéo</h1>

<div class="filtres">

<form method="POST">

<label>Genre :</label>
<!-- OPTIONS GENRES (à remplacer par du code php) -->
<select name="genre">

<option value="">Tous</option>
<?php
    if(mysqli_num_rows($res_select) >0 ){
        while($ligne_sel = mysqli_fetch_assoc($res_select)){
            print("<option value='".$ligne_sel['id']."'>".$ligne_sel['nom_genre']."</option>");
        }

    }
?>


</select>

<br><br>

<label>Note :</label>

<input type="radio" name="note" value="all" checked> Tous
<input type="radio" name="note" value="10"> 0 à 10
<input type="radio" name="note" value="15"> 11 à 15
<input type="radio" name="note" value="20"> 16 à 20

<br><br>

<button type="submit" name="mon_filtre">Filtrer</button>

</form>

</div>

<div class="timeline">

<!-- AFFICHAGE DES JEUX (à remplaceer par du code php) -->

<?php
    if(mysqli_num_rows($res_jeux) >0 ){
        while($ligne_jeu = mysqli_fetch_assoc($res_jeux)){
            print("
            <div class='jeu'>

            <h2>".$ligne_jeu['titre']."</h2>

            <p><strong>Année :</strong> ".$ligne_jeu['annee_sortie']."</p>

            <p><strong>Genre :</strong> ".$ligne_jeu['nom_genre']."</p>

            <p><strong>Studio :</strong>".$ligne_jeu['nom_studio']."</p>

            <p><strong>Note :</strong> ".$ligne_jeu['note']."</p>

            <p><strong>Ajouté par :</strong> ".$ligne_jeu['ajoute_par']."</p>

            </div>
            ");
        }

    }

?>





</div>

<hr>

<h2>Ajouter un jeu</h2>

<form method="POST">

<input type="text" name="titre" placeholder="Titre">

<br>

<input type="number" name="annee" placeholder="Année">

<br>

<input type="number" name="note_insert" placeholder="Note">

<br>

<select name="genre_insert">

<?php
    if(mysqli_num_rows($res_select) >0 ){
        while($ligne_sel = mysqli_fetch_assoc($res_select)){
            print("<option value='".$ligne_sel['id']."'>".$ligne_sel['nom_genre']."</option>");
        }

    }
?>

</select>

<br>

<select name="studio_insert">



</select>

<br>

<input type="text" name="auteur" placeholder="Votre prénom">

<br>

<button type="submit" name="mon_ajout">Ajouter</button>

</form>

</body>
</html>