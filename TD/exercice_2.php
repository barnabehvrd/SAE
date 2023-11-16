<?php

/**
 * 
 * Exercice 2 : Comptes utilisateurs
 * 
 * Créer un formulaire HTML d’inscription avec ces champs : 
 *  nom
 *  prenom
 *  email
 *  motdepasse (pensez à le sécuriser)
 * Lors de la soumission du formulaire, enregistrer les données dans un fichier json
 * Créer un tableau qui liste les utilisateurs 
 * 
 * 
 */     



if(isset($_POST['nom']) && isset($_POST['password'])){
    save_user($_POST['nom'],$_POST['prenom'],$_POST['mail'],$_POST['password']);
} 


function save_user($nom,$prenom,$mail,$password){

    $users = get_users();
    $new_user = array(
        'nom'=>$nom,
        'prenom'=>$prenom,
        'mail'=>$mail,
        'password'=>password_hash($password,PASSWORD_BCRYPT),
    );

    $users[] = $new_user;

    $usersJson = json_encode($users);
    file_put_contents('users.json',$usersJson);
}

function get_users(){
    $json = file_get_contents('users.json');
    $array = json_decode($json,true);
    return $array;
}

 ?>
<form method="post">
    <div>
        <input type="text" name="prenom" placeholder="Prénom ....">
    </div>
    <div>
        <input type="text" name="nom" placeholder="Nom ....">
    </div>
    <div>
        <input type="email" name="mail" placeholder="Email ....">
    </div>
    <div>
        <input type="password" name="password" placeholder="Mot de passe ....">
    </div>
    <div>
        <button type="submit">S'inscrire</button>
    </div>
</form>

<table>
    <tr>
        <th>
            Nom
        </th>
        <th>
            Prénom
        </th>
        <th>
            Email
        </th>
    </tr>
    <?php 
    $users = get_users();
    if(is_array($users)){
        foreach($users as $user){
        ?>
        <tr>
            <td><?php echo $user['nom'];?></td>
            <td><?php echo $user['prenom'];?></td>
            <td><?php echo $user['mail'];?></td>
        </tr>
    <?php } 
    }
   ?>
</table>


<?php

