<?php
//This page let display the list of topics of a category
include('html/mainheader.php');
?>
 <div id="page-wrapper"> 
       <div class="main-page">
    <?php
if(isset($_GET['parent']))
{
	$id=$_GET['parent'];
	$dn1 = mysqli_query($link2,'select nom_onglet, id_onglet from onglet where id_formulaire = "'.$id.'"');
	?>
	
          
    <table class="topics_table">
    <tr>
            <th class="forum_tops">Onglet</th>
    </tr>
    	<?php
    while($dnn1 = mysqli_fetch_array($dn1)){
        ?>
    <tr>
    	<td>
            <a href="formulaire.php?id=<?php echo $dnn1['id_onglet']; ?>"><?php echo $dnn1['nom_onglet']; ?>
        </td>
    </tr>
    <?php
    }
    ?>
    </table>
	<a href="new_onglet.php?parent=<?php echo $id; ?>" class="btn btn-primary">Nouveau Onglet</a>
            
    
<?php
}
?>  
       </div>
       </div>
     <?php include("html/mainfooter.html");?>