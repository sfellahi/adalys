<script>
    var arrayname= [];  
function appelFonction(element1,type1,name1,question1,reponse1,required1){
    var element=document.getElementById("ajouter");
    var formulaire = window.document.formulaireDynamique;
    var type= type1;
     var name= name1;
      var question= question1;
       var reponses= reponse1;
        var required= required1;
        // var element= document.getElementById('ajouter');
	  var res = reponses.split(";");
	  // on recupere le nombre de reponse 
	  var taillereponses = res.length;
	   // On crée le bloc
      var bloc = document.createElement("p");
// On initialise le type 
	  var typechamp="input";
	  //  Mise en place des differents pattern 
	  // IL FAUT CREER UNE FONCTION QUI RETOURNE LE PATERN
	// var  patterndate="(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/(19|20)[0-9]{2}";
	// var  patternchiffre="[0-9]";
// initialisation d'un saut de ligne 
	  var sautligne = document.createElement('br');
	  
	  // On crée une ligne avec la question
	  var nominatifquestion = document.createTextNode(question);

	  
	  
	  // A PARTIR DE LA ON SEPARER LES TPES DE QUESTION
	  
	  
	  
	  if(type==='textarea'){
	  var typechamp='textarea';	  }
	  // Si jamais c'est un checkbox ou une radio 
	  if(type==='radio' || type==='checkbox'){
	
	  // On crée les differentes radio et checkbox 
	  for (var i = 0; i < taillereponses; i++) {  
	  
	        var champ = document.createElement(typechamp);
      // Les valeurs encodée dans le formulaire seront stockées dans un tableau
      champ.name = name;
      
      champ.type = type;
	  
 if(type==='checkbox'){
// mise en place d'ID
	   champ.id="checkbox"+i; 
	   champ.className = "checkbox";
	  }
	  else{
		  
		  champ.className = 'radio';
	  // Si le bouton radio est requis
	  	  	  if(required==='oui'){
	  champ.required="required";
	  }
	  // mise en place d'ID 
	   champ.id="radio"+i;
  }
	
      champ.value = res[i];
	    var nominatifreponses = document.createTextNode(res[i]);
		if(i==='0'){ 
		// On initialise une question et un saut de ligne
		bloc.appendChild(nominatifquestion);
		bloc.appendChild(sautligne);
		
		}
		// Pour chaque itération on met la reponse et le champ associé 
		bloc.appendChild(champ);
	  bloc.appendChild(nominatifreponses);
      
        }      var sup = document.createElement("input");
      sup.value = "-";
      sup.className = "bouton_supprimer";
      sup.type = "image";
	  sup.id = name;
      // Ajout de l'événement onclick
      sup.onclick = function onclick(event)
         {suppression(this,type,name,question,reponses,required);};
        
	// on met en place la question 

      // On crée un nouvel élément de type "p" et on insère le champ l'intérieur.


    //  formulaire.insertBefore(ajout, element);
      formulaire.insertBefore(sup, element);
      formulaire.insertBefore(bloc, element);
        arrayname.push(type,name,question,reponses,required);
		
}
else if(type==="selection"){
      var champ = document.createElement("select");
	  
	  champ.name = name;
var champdebase = document.createElement("option");
 champ.appendChild(champdebase);
for (var j = 0; j < taillereponses; j++) {
    var option = document.createElement("option");
    option.value = res[j];
    option.text = res[j];
    champ.appendChild(option);
}
	  	  if(required==="oui"){
	  champ.required="required";
	  }
bloc.appendChild(nominatifquestion);
		bloc.appendChild(sautligne);
      bloc.appendChild(champ);
	        var sup = document.createElement("input");
      sup.value = "-";
      sup.className = "bouton_supprimer";
      sup.type = "image";
	  sup.id = name;
      // Ajout de l'événement onclick
      sup.onclick = function onclick(event)
         {suppression(this,type,name,question,reponses,required);};
        
	// on met en place la question 

      // On crée un nouvel élément de type "p" et on insère le champ l'intérieur.


    //  formulaire.insertBefore(ajout, element);
      formulaire.insertBefore(sup, element);
      formulaire.insertBefore(bloc, element);
	   arrayname.push(type,name,question,reponses,required);
   }
	 else{
      var champ = document.createElement(typechamp);
      // Les valeurs encodée dans le formulaire seront stockées dans un tableau
      champ.name = name;
      champ.type = type;
	  champ.className = "input_text";
	  if(required==="oui"){ champ.required="required"; }
	
	  
// On ajoute les reponses possible dans le paragraphe 
		bloc.appendChild(nominatifquestion);
		bloc.appendChild(sautligne);
      bloc.appendChild(champ);
              var sup = document.createElement("input");
      sup.value = "-";
      sup.id = name;
      sup.className = "bouton_supprimer";
      sup.type = "image";
      // Ajout de l'événement onclick
      sup.onclick = function onclick(event)
	  // ici on recupere le name de l'input pour pouvoir supprimer la ligne dans la bdd
         {suppression(this,type,name,question,reponses,required);};
// On insere la question dans le bloc avec le bouton de suppression
      formulaire.insertBefore(sup, element);
      formulaire.insertBefore(bloc, element);
	   arrayname.push(type,name,question,reponses,required);
        }
 document.formulaireDynamique.value1.value = arrayname;
}
function suppression(element,type,name,question,reponses,required){
   var formulaire = window.document.formulaireDynamique;
    arrayname.splice(arrayname.indexOf(type),1);
    arrayname.splice(arrayname.indexOf(name),1);
    arrayname.splice(arrayname.indexOf(question),1);
    arrayname.splice(arrayname.indexOf(reponses),1);
    arrayname.splice(arrayname.indexOf(required),1);
   // alert(name);
   formulaire.removeChild(element.nextSibling);
   // Supprime le bouton de suppression
  
   formulaire.removeChild(element);
   document.formulaireDynamique.value1.value = arrayname;
}
</script>
 <?php
//This page displays the list of the forum's categories
include('html/mainheader.php');
$id=0;?> 

 ?>
<html>
    
    <form name="formulaireDynamique"  id="formulaireDynamique" method="POST" action="enregistrer.php?id=<?php echo $id; ?>">
      <?php 
$sql_recup_question="SELECT id_question, type_question, id_type, colonne_assoc, qrequired FROM ordre_question WHERE id_formulaire=".$id."";
$result_question = mysqli_query($link2,$sql_recup_question);
if ($result_question) {

while($temp_question = mysqli_fetch_array($result_question))
    {
    $typequestion=$temp_question['type_question'];
    $colonne_assoc=$temp_question['colonne_assoc']; 
   $qrequired=$temp_question['qrequired'];
    if($typequestion=="checkbox" || $typequestion=="radio" || $typequestion=="select"){
    $sql_recup_question_reponses="SELECT question,reponse_".$typequestion." FROM ".$typequestion." WHERE id_".$typequestion."=".$temp_question['id_type']."";
    $result_recup_question_reponses = mysqli_query($link2,$sql_recup_question_reponses);
    while($temp_recup_question_reponses = mysqli_fetch_array($result_recup_question_reponses))
    {
     $question=$temp_recup_question_reponses['question']; 
     $a="reponse_".$typequestion."";
     $reponses=$temp_recup_question_reponses[$a];     
    }
    }
    else{
    $sql_recup_question="SELECT question FROM ".$typequestion." WHERE id_".$typequestion."=".$temp_question['id_type']."";
    $result_recup_question = mysqli_query($link2,$sql_recup_question);
    while($temp_recup_question = mysqli_fetch_array($result_recup_question))
    {
       $question=$temp_recup_question['question']; 
       $reponses="NULL"; 
    }
    }
   //     var type= '<?php echo $typequestion; ';
   //  var name= '<?php echo $colonne_assoc; ';
    //  var question= '<?php echo $question; ';
     //  var reponses= '<?php echo $reponses; ';
       // var required= '<?php echo $qrequired; ';
?>
 <!-- <input type="button" style="margin-top:200px;" id="ajouter" name="ajouter" onClick="appelFonction(this,'<?php echo $typequestion;?> ','<?php echo $colonne_assoc; ?>','<?php echo $question;?>','<?php echo $reponses;?>','<?php echo $qrequired;?>');"  value="ajouter un champ"/> 
  -->
<script>appelFonction(this,'<?php echo $typequestion;?> ','<?php echo $colonne_assoc; ?>','<?php echo $question;?>','<?php echo $reponses;?>','<?php echo $qrequired;?>');</script>
    <?php
}
    }
?>
        
        
        <input type="button" id="ajouter" onClick="ajout(this);" style="" value="ajouter un champ"/>
        <input type="submit" value="Soumettre">
    </form>
</html><?php

?>
