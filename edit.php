<?php
require 'db.php';
$id = $_GET['id'];
$sql = 'SELECT * FROM personne WHERE id=:id';
$statement = $connection->prepare($sql);
$statement->execute([':id' => $id ]);
$person = $statement->fetch(PDO::FETCH_OBJ);
if (isset ($_POST['name'])  && isset($_POST['email']) && isset ($_POST['birthdate']) && isset ($_POST['city']) ) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $birthdate = $_POST['birthdate'];
  $city = $_POST['city'];

  $sql = 'UPDATE personne SET name=:name, email=:email, birthdate=:birthdate, city=:city WHERE id=:id';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':name' => $name, ':email' => $email, ':birthdate' => $birthdate, ':city' => $city, ':id' => $id])) {
    header("Location: index.php");
  }



}


 ?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update person</h2>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" value="<?= $person->name; ?>" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="<?= $person->email; ?>" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
          <label for="birthdate">BirthDate</label>
          <input type="date" value="<?= $person->birthdate; ?>" name="birthdate" id="birthdate" class="form-control">
        </div>
        <div class="form-group">
          <label for="city">City</label>
          <input type="text" value="<?= $person->city; ?>" name="city" id="city" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success"><img src="img/ed.png"></button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>
