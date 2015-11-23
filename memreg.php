<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css">
<div class="alert alert-dismissible alert-success">
  <strong>Successfully registered:</strong><br>
  <?php
  echo "<strong>Name: </strong>", htmlspecialchars($_POST['name']), "<br>";
  echo "<strong>Email: </strong>", htmlspecialchars($_POST['email']), "<br>";
  ?>
</div>
<div class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Hey!</strong> You'll need to make note of your member ID, it'll function as your password.
</div>
<a href="index.html" class="btn btn-link">Back home</a>
