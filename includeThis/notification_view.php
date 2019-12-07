<?php
  include('../config/config.php');

  $id=$_GET['id'];
  $status = '1';
    //set notif to read first.
  $sql = 'UPDATE notif 
            SET "status" = ? 
            WHERE "id"= ?';
  $q = $pdo->prepare($sql);
  $q->execute(array($status,$id));

  $result = $pdo->prepare('SELECT * 
                            FROM notif
                            WHERE "id" = :id');
  $result->bindParam(':id', $id);
  $result->execute();
  for($i=0; $rows = $result->fetch(); $i++){

?>

<div class="modal-header">
  <h3 class="modal-title" id="exampleModalLabel">Notification</h3>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">

  <form name="dept">
    <div class="title form-group"> <h4><?php echo "Subject: ".$rows['title'] ?> <br/ > <small> <?php echo date('F j, Y, g:i a',strtotime($rows['date']))?> </small> </h4>
    </div>

    <div class="body form-group"> <h3><?php echo "Message: ".$rows['body'] ?></h3>
    </div>



  </form>


<?php 
  }
?>

</div>

<div class="modal-footer"> 
  <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="refresh()">Close</button>
</div>

<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<script>
  function refresh(){
    location.reload();
}
</script>

