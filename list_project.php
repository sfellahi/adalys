<?php
include('html/mainheader.php');
?>
<div id="page-wrapper">
            <div class="main-page">
                <div class="row">
<table class="flat-table" border="0" id="tableprojet" cellspacing="0">
    <tr>
        <th>Nom du projet</th>
        <th style="width:10%">Date de creation</th>
        <th style="width:10%">Nb de patient</th>
        <th>Formulaires</th>
        <th>Etat du projet</th>
        <th>Lié un médecin</th>
    </tr>   
<?php
$dn1 = mysqli_query($link,'select id_project, nom_project, date_debut, nombre_patient, etat_project from projects');
if ($dn1) {
while($dnn1 = mysqli_fetch_array($dn1))
    {
    ?>
    <tr>
        <td class="forum_cat"><a href="list_formulaire.php?parent=<?php echo $dnn1['id_project']; ?>" class="title"><?php echo $dnn1['nom_project']; ?></td>
        <td><?php echo $dnn1['date_debut']; ?></td>
        <td ><span style=""><?php echo $dnn1['nombre_patient']; ?></span></td>
        <td>
                 <a href="#" class="btn btn-info">
          <span class="glyphicon glyphicon-tasks"></span> Liste 
        </a>
            
            <a href="new_formulaire.php?parent=<?php echo $dnn1['id_project'];?>" class="btn btn-primary"><span class="glyphicon glyphicon-wrench"></span> Nouveau</a></td>
        <td><form action="change_etat.php?parent=<?php echo $dnn1['id_project']; ?>" name="changeretat" id="changeretat" method="post">
			<div>
			<select name="etat" id="etat" onChange="changerEtat('<?php echo $dnn1['nom_project']; ?>')">
		  		<option value="<?php echo $dnn1['etat_project']; ?>" selected ><?php echo $dnn1['etat_project']; ?></option>
				<option value="En création">En création</option>
				<option value="En cours">En cours</option>
				<option value="Cloturé">Cloturé</option>
			</select>
		    </div>
		 	</form>
 		</td>
 		<?php
 		$dn2 = mysqli_query($link,'select id, nom, prenom from users where profil = "medecin"'); 
 		while($dnn2 = mysqli_fetch_array($dn2)){
 			?>

 		<form action="user_project.php?parent=<?php echo $dnn1['id_project']; ?>" method="post">
 			<td><select name="medecin">
		  		<option value="<?php echo $dnn2['id']; ?>"><?php echo $dnn2['nom'] ." ". $dnn2['prenom'] ; ?></option>
			</select>
			</td>
			<?php 
    	}
			?>
 			<td><button type="submit">Lié</button></td>
 		</form>			
    </tr>
    <?php
    }?>
</table>
                </div>
    </div>
    </div>

<?php
}
include("html/mainfooter.html");?>
<script>
function changerEtat(projet){
    var formulaire = window.document.changeretat;
    	  var e= document.getElementById("etat");
	  var etat = e.options[e.selectedIndex].value;
       
          if(etat==='En cours'){
                   if(confirm('Vous allez mettre en production le projet ' + projet +' souhaitez-vous donnez accès aux utilisateurs ?')){
  document.getElementById('changeretat').submit();
              }   
              
          }
          else if(etat==='Cloturé'){
              if(confirm('Vous allez clore le projet ' + projet +' souhaitez-vous supprimer l\'acces de ce projet ?')){
       document.getElementById('changeretat').submit();      
                  
        
              }
              
          }
          else{
    
              
          }
    
    
}

</script>