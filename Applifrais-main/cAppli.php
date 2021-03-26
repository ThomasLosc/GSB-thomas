
<?php
/** 
 * Script de contrôle et d'affichage du cas d'utilisation "Consulter une fiche de frais"
 * @package default
 * @todo  RAS
 */
  $repInclude = './include/';
  require($repInclude . "_init.inc.php");

  // page inaccessible si visiteur non connecté
  if ( !estVisiteurConnecte() || $_SESSION["numPoste"] != 0) {
    header("Location: cSeConnecter.php");  
  }

  $req = "SELECT id, nom, prenom 
            FROM practicien 
            ORDER BY nom";

$listeUser = mysqli_query($idConnexion, $req);
$donnees = mysqli_fetch_row($listeUser);
$result = $idConnexion->query($req);

  require($repInclude . "_entete.inc.html");
  require($repInclude . "_sommaire.inc.php");
 ?>


<div id="contenu">
<!---------------------------------------------------------------------------------------------------------------->
	<h2 style="text-align: center; color: red;">Rapport de visite</h2>
<br>
	
 <!---------------------------------------------------------------------------------------------------------------->
<div style=" margin-left:2%; width:100%; height: 5%;">
  	<input "type="text" id="fname" name="fname" placeholder="Numéro Rapport">
</div>
<br>
 	<!---------------------------------------------------------------------------------------------------------------->
<div style="margin-left:2%; width:100%; height: 5%;>
	 <form action="cValidationFichesFrais.php" method="post">
	<select id="idVisi" name="idVisi" title="Sélectionnez le visiteur souhaité">

<?php 
if($result->num_rows > 0) {
    while($donnees = $result->fetch_assoc()) {
        $userN = $donnees["nom"];
        $userP = $donnees["prenom"];
        $userID = $donnees["id"];
?>    
    <option value="<?php echo $userID; ?>"> <?php echo $userN ." ". $userP; ?> </option>
<?php
    }
} else {
    echo 'NO RESULTS';  
}
?>
</select>
 
            <input style="margin-left:2%;" 
            	   type="button" 
            	   value="Détails" 
            	   id="ok"  
            	   ata-container="body" 
            	   data-toggle="popover" 
            	   data-placement="right" 
            	   class="myPopover"
           		   data-toggle="popover"
            	   data-placement="right" 
            	   data-trigger="hover"
            	   data-html="true"
            	   data-popover-content="#myPopoverContent">
 
         <!-- Content for Popover: -->
         <div id="myPopoverContent" style="display:none">
            <ol style="margin-left: 5%;">
               <li>Numéro :</li>
               <li>Nom :</li>
               <li>Prenom</li>
               <li>Adresse:</li>
               <li>Ville :</li>
               <li>Coeff Notorie :</li>
               <li>Lieu d'exercice :</li>
            </ol>
         </div>
 
      </div>
 
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 
      <script>
         $('.myPopover').popover({
         html : true,
         content: function() {
          var elementId = $(this).attr("data-popover-content");
          return $(elementId).html();
         }
         });
      </script>
      <br>
<!---------------------------------------------------------------------------------------------------------------->
<div style="margin-left:2%; width:100%; height: 5%;">
	<input type="date" id="start" name="trip-start"value="2018-07-22" min="2018-01-01" max="2025-12-31">
</div>
<br>
<!---------------------------------------------------------------------------------------------------------------------->
<div style="margin-left:2%; width:100%; height: 5%;">
  	<input "type="text" id="fname" name="fname" placeholder="Motif Visite">
</div>
<br>
<!--------------------------------------------------------------------------------------------------------------------->
<div style="margin-left:2%; width:100%; height: 5%;">
   <textarea name="message" rows="6" cols="21" value="..." placeholder="Bilan"></textarea>
   <textarea style="margin-left:3%;" name="message" rows="6" cols="21" value="..." placeholder="Offre d'échantillons"></textarea>
</div>
<br>
<!--------------------------------------------------------------------------------------------------------------------->
<div style="margin-left:2%; width:100%; height: 5%;">
	<input type="button" value="Précédent">
	<input style="margin-left:2%;" type="button" value="Suivant">
	<input style="margin-left:2%;" type="button" value="Nouveau">
	<input style="margin-left:10%;" type="button" value="Fermer">
</div>

<!--------------------------------------------------------------------------------------------------------------------->

</div>


<?php        
  require($repInclude . "_pied.inc.html");
  require($repInclude . "_fin.inc.php");
?> 