<!-- La partie HTML commence ici. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Lien vers la page CSS de mon projet -->
   <link rel="stylesheet" href="style.php" media="screen">
   <!-- Ici, je renseigne le nom de mon site/ma page-->
    <title>Ma liste de tâches</title>
</head>
<body>

<!-- Je créée un H1 pour afficher le nom de la page et le mettre tout en haut, pour la mise en forme.-->
<div class="banniere">
  <h1 class="titre">
    <span class="title-word title-word-1">ma</span>
    <span class="title-word title-word-2">liste</span>
    <span class="title-word title-word-3">de</span>
    <span class="title-word title-word-4">tâches</span>
  </h1>
</div>

<!-- Je crée mon formulaire ici, je l'ai séparé en divs, pour pouvoir le mettre en forme de manière plus lisible -->
<form tasks="index.php" method="post">
    <!-- Dans cette div j'ai mis les champs et le bouton qui me permettront d'ajouter des tâches à mon tableau ainsi que
    leur date d'expiration-->
    <div id="ajout" class="bloc">
        <p>Nom de la tâche: <input type="text" name="title" placeholder="ex: Chanter" /></p>
        <p>Description de la tâche: <input type="text" name="desc" placeholder="ex: Faire saigner des oreilles" /></p>
        <p>Date de fin: <input type="date"  name="expiration"
       value="2022-12-15"
       min="2022-01-01" max="2030-12-31">
        <p><input type="submit" value="Ajouter" name="OK" ></p>
    </div>
    <!-- Dans cette div j'ai créé un bouton qui me permet de lancer le code pour nettoyer mon tableau et archiver 
    les tâches expirées -->
    <div id="maj" class="bloc">
        <p>Archiver les tâches expirées: <input type="submit" value="Mettre à jour" name="maj" ></p>
    </div>
    <!-- Dans cette div j'ai inséré le champs et le bouton qui me permettent de supprimer une tâche spécifique -->
    <div id="supprimer" class="bloc">
        <p>Tâche à supprimer: <input type="text" name="suppr" placeholder="Nom de la tâche"/></p>
        <p><input type="submit" value="Supprimer" name="erase" ></p>
    </div>
    <!-- Dans cette div j'ai mis un champs et un bouton qui me permettent d'archiver les tâches finies avant leur
    date d'expiration -->
    <div id="archivage" class="bloc">
        <p>Tâche finie: <input type="text" name="fini" placeholder="Nom de la tâche"/></p>
        <p><input type="submit" value="Archiver" name="archive" ></p>
        </div>
        <!-- Dans cette div j'ai inséré un bouton qui me permet de complètement vider mon tableau sans rien archiver -->
    <div id="destroy" class="bloc">
        <p><input type="submit" value="Tout supprimer" name="destroy"></p>
    </div>
 
</form>

</body>
</html>


<!-- La partie PHP commence ici -->
<?php

// Je commence une session ici.
session_start();

    //Ici, je récupère les données du formulaire quand on clique sur le bouton "Ajouter"
    // et je les stocke dans le tableau, si le tableau n'existe pas, il est créé.
    if(isset($_POST['OK'])){
        if(isset($_SESSION['tableau'])) {
            $_SESSION['tableau'][$_POST['title']] = $_POST['desc'];
            
        }
        else{
            $_SESSION['tableau']=[];
            
        }

        //Ici je récupère la date d'expiration de la tâche et la stocke en tant que valeur dans un tableau qui partage les même 
        //clés que le tableau de dessus. Si il n'existe pas, il est créé.
        if(isset($_SESSION['date'])) {
            $_SESSION['date'][$_POST['title']] = $_POST['expiration'];
            
        }
        else{
            $_SESSION['date']=[];
            
        }

}

    //Ici, le contenu du tableau s'affiche ligne par ligne.
    //print "<pre>";
    //print_r($_SESSION['tableau']);
    //print "</pre>";

    foreach ($_SESSION['tableau'] as $key => $value) {
        echo " <div id = 'nom'> $key: $value. <br> </div>";
        
    }


    //En entrant le nom de la tâche et en appuyant sur "supprimer", on compare les éléments du tableau avec le nom
    //entré dans le formulaire et on efface l'élément correspondant si il existe.
     if(isset($_POST['erase'])) {
       
        foreach ($_SESSION['tableau'] as $key => $value) {
            if ($key == $_POST['suppr']) {
            unset($_SESSION['tableau'][$key]);
            }
    }

        //Le nom de la tâche est ensuite comparé aux éléments du tableau "date" et si il y a une correspondance, la tâche et
        //sa date d'expiration sont supprimées et la page est rafraichie pour afficher le tableau sans la tâche effacée.
        foreach ($_SESSION['date'] as $key => $value) {
            if ($key == $_POST['suppr']) {
            unset($_SESSION['date'][$key]);
            header("Refresh:0");
            }
    }
}

    //Ici, en entrant le nom de la tâche finie et en cliquant sur "archiver", on compare les éléments du tableau avec 
    //ce que le formulaire a retourné et on copie l'élément dans le fichier texte "archive",
    // suivi d'un espace car on va ensuite afficher la date d'expiration de la tâche, avant de l'effacer du tableau.
    if(isset($_POST['archive'])) {
       
        foreach ($_SESSION['tableau'] as $key => $value) {
            if ($key == $_POST['fini']) {
                file_put_contents('archive.txt', print_r($key,true). " ", FILE_APPEND);
                unset($_SESSION['tableau'][$key]);
            }
    }

    //Le nom de la tâche est comparée ici aux éléments du tableau "date", si il y a correspondance, la valeur contenant la date
    //est ajoutée au tableau derrière le nom de la tâche.Ensuite la page est rafraichie pour actualiser le tableau. 
    //le "\n" permet de mettre une tâche par ligne dans le fichier texte pour que ça soit plus lisible.
        foreach ($_SESSION['date'] as $key => $value) {
            if ($key == $_POST['fini']) {
                file_put_contents('archive.txt', print_r($value,true). "\n", FILE_APPEND);
                unset($_SESSION['date'][$key]);
                header("Refresh:0");
            }
    }
}

    // Si on clique sur le bouton "tout supprimer", les tableaux se vident entièrement, le fichier txt d'archive 
    //est ouvert (en lecture/écriture) et est remis à zéro et la page est rafraichie pour afficher le tableau des tâches vierge.
    if(isset($_POST['destroy'])) {
        $_SESSION['tableau']=[];
        $_SESSION['date']=[];
        $fichier = fopen('archive.txt', 'r+'); 
        ftruncate($fichier, 0);
        header("Refresh:0");
    }


    //En cliquant sur le bouton "mettre à jour", la variable "today" récupère la date du jour, et la variable "date" la formatte 
    //en string de manière à ce qu'elle soit au même format que la date des tâches dans le tableau "date" (grâce aux arguments
    //de la fonction format). Ensuite, si l'une des dates contenues dans les valeurs du tableau "date" est inférieure à la date actuelle
    //dans ce cas, la clé (nom de la tâche) et la valeur (date d'expiration) sont archivées, elles sont ensuites supprimées des deux tableaux
    //"date" et "tableau". La page est rafraichie pour afficher le tableau mis à jour, sans tâches dont la date a expiré.
    if(isset($_POST['maj'])) {
       
        $today = new DateTime();
        $date = $today->format("Y-m-d");

        foreach ($_SESSION['date'] as $key => $value) {
            if ($value < $date) {
                file_put_contents('archive.txt', print_r($key,true). " ".($value). "\n", FILE_APPEND);
                unset($_SESSION['date'][$key]);
                unset($_SESSION['tableau'][$key]);
                header("Refresh:0");
            }
    }

}

?>