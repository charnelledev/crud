<?php
require 'dbconnect.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud</title>
    <link rel="stylesheet" href="./src/outp fhgjut.css">
</head>
<body>

    <h2></h2>

<form method="post" action="" class="bg-white p-6 rounded-lg shadow-md">
    
 <input type="text" name="nom" id="input" placeholder="Nom">
 
 <input type="text" name="prenom" id="input2" placeholder="Prenom">

    <input type="email" name="mail" id="input3" placeholder="Mail">
<input type="submit" name="submit" value="submit">      





</form>
<?php
require 'dbconnect.php';
if(isset($_POST{'submit'}) &&
!empty($_POST["nom"]) &&
!empty($_POST["prenom"])&&
!empty($_POST["mail"]))
{
$nom=$_POST["nom"];
$prenom=$_POST["prenom"];
$mail=$_POST["mail"];
$sql="  INSERT INTO `personne` (nom, prenom, mail) VALUES(:nom,:prenom,:mail)";
$stmt=$pdo->prepare($sql);
$stmt->execute(['nom' => $nom, 'prenom' => $prenom, 'mail' => $mail]);
}else{
    echo"veiller remplir tous les champs";
}

?>
       <table border='1'>
        <tr>
            <th class=''>ID</th>
            <th >NOM</th>
            <th >PRENOM</th>
            <th >MAIL</th>
            <th >ACTIONS</th>
        </tr>

        
        
        
        <?php
$sql="SELECT *  FROM `personne`";
$stmt=$pdo->query($sql);
while ($row=$stmt->fetch()){
    echo "<tr>";
    echo "<td> " . $row['id'] . "</td>" ;
    echo "<td> " . $row['nom'] . "</td>";
    echo "<td> " . $row['prenom'] . "</td>";
    echo "<td> " . $row['mail'] . "</td>";
    echo "<td>
        <a href='?edit=" . $row['id'] . "'>Modifier</a> |
        <a href='?delete=" . $row['id'] . "' onclick='return confirm(\"Supprimer ?\");'>Supprimer</a>
    </td>";
    echo "</tr>";
}
if (isset($_GET['delete'])){
    $id=$_GET['delete'];
    $sql="DELETE FROM personne WHERE id = :id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    
}
if(isset($_GET['edit'])){
    $id=$_GET['edit'];
    $sql="SELECT * FROM personne WHERE id = :id";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $cc=$stmt->fetch();

    
    ?>

<form action="" method="POST">
    <input type="hidden" value="<?php echo $cc['id']; ?>" name="id">
    <input type="text" value="<?php echo $cc['nom']; ?>" name="nom">
    <input type="text" value="<?php echo $cc['prenom']; ?>" name="prenom">
    <input type="email" value="<?php echo $cc['mail']; ?>" name="mail">
    <input type="submit" value="update" name="ma">
</form>
</table>

<?php
}
if(isset($_POST['ma'])){
    echo "update";
}
?>

</body>
</html>