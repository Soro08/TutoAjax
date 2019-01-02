<?php
 require 'config/database.php';
 $db = Database::connect();
        // Requette Sql pour selectionner tous les utilisateurs

  $statatement = $db->query("SELECT * FROM user");
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>NaN TuTo - Soro Nbe</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">

  <link href="pnotify/pnotify.custom.css" rel="stylesheet">


</head>

<body>

  <!-- Start your project here-->
  
  <div class="container">
  	<hr>
  	<br>
    <h3 style="text-align: center;">Ajax tuto </h3>
  	<hr>
  	<!-- Grid row -->
<div class="row">
	<br>

<?php while ($item = $statatement->fetch()) {?>

  
  <!-- Grid column -->
  <div class="col-lg-3 col-md-12">

    <!--Card Wider-->
    <div class="card card-cascade wider">

      <!--Card image-->
      <div class="view view-cascade overlay">
        <img src="images/<?= $item['image'] ?>" class="card-img-top"
          alt="wider">
        <a href="#!">
          <div class="mask rgba-white-slight"></div>
        </a>
      </div>
      <!--/Card image-->

      <!--Card content-->
      <div class="card-body card-body-cascade text-center">
        <!--Title-->
        <h4 class="card-title"><strong><?= $item['name'] ?></strong></h4>
        <h5 class="indigo-text"><strong><?= $item['email'] ?></strong></h5>

        <p class="card-text"><?= $item['address'] ?> <br>
          <?php 
            $id = $item['id'];
            if ($item['statut'] == 0) {
            
           echo '<span id="statut-'.$id.'" class="badge badge-pill badge-warning">En attente</span>';
          }else{
            echo '<span id="statut-'.$id.'" class="badge badge-pill badge-success">Activé</span>';
          }

           ?>
         
        </p>
        <form class="formsib" id="formsib">
    
                        <input id="iduser" name="iduser" type="hidden" value="<?= $item['id'] ?>" />
                         <input id="statut" name="statut" type="hidden" value="<?= $item['statut'] ?>" />
                        <button type="submit" class="btn aqua-gradient"><i class="fa fa-pencil"></i> Edit </button>
                    </form>
      </div>
      <!--/.Card content-->

    </div>
    <!--/.Card Wider-->

  </div>
  <!-- Grid column -->
<?php }  ?>

</div>
<!-- Grid row -->





  </div>
  <!-- /Start your project here-->




  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
 <script src="pnotify/pnotify.custom.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
        console.log("Charge");

        $('.formsib').on('submit', function () {
            var id = $(this).find('#iduser').val();
            var  statut = $(this).find('#statut').val();
            $.post('postAjax.php', {iduser:id, statut:statut});
            var tr = "#statut-"+id;
            console.log('oui');
            if(statut == 0){
                $(tr).html('Activé').removeClass('badge badge-pill badge-warning').addClass('badge badge-pill badge-success');

                $(this).find('#statut').val('2');
                

                new PNotify({
                    title: 'Etudiant activé avec succès,',
                    text: 'Vous venez de modifier le statuts du student !',
                    type: 'success'
                });

            }
            else{
                $(tr).html('En attente').removeClass('badge badge-pill badge-success').addClass('badge badge-pill badge-warning');
                $(this).find('#statut').val('0');
                console.log(statut);

                new PNotify({
                    title: 'Etudiant archivé avec succès!',
                    text: 'Vous venez de modifier le statuts du student!',
                    type: 'error'
                });
            }


            return false;
        });

    });
</script>

</body>

</html>
