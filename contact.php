<?php
$errors = [];
$missing = [];
if (isset($_POST['send'])) {
    $expected = ['name', 'email', 'comments'];
    $required = ['name', 'comments'];
    $to = 'Taofeek Olayiwola <taofeeq.olayiwola@yahoo.com>';
    $subject ='Feedback from online form';
    $headers = [];
    $headers[] = 'From: taofeeq.issa076@gmail.com';
    // $headers[] = 'Cc: softdev@envivocom.net, taofeeq.olayiwola@yahoo.com';
    $headers[] = 'Content-type: text/plain; charset=utf-8';
    $authorized = '-ftaofeeq.issa076@gmail.com';
    require './includes/process_mail.php';
    if ($mailSent) {
      header('Location: thanks.php');
      exit;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Get and post</title>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<h1>Contact Us</h1>
<?php if ($_POST && ($suspect || isset($errors['mailfail']))): ?>
<p class="warning">Sorry, your mail couldn't be sent.</p>
<?php elseif ($errors || $missing) : ?>
<p class="warning">Please fix the item(s) indicated</p>
<?php endif; ?>
<form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
  <p>
    <label for="name">Name:
      <?php if ($missing && in_array('name', $missing)) : ?>
        <span class="warning">Please enter your name</span>
      <?php endif; ?>
    </label>
    <input type="text" name="name" id="name"
        <?php 
        if($errors || $missing){
          echo 'value="' .htmlentities($name) .'"'; 
        }
        ?>
    >
  </p>
  <p>
    <label for="email">Email:
      <?php if ($missing && in_array('email', $missing)) : ?>
        <span class="warning">Please enter your email address</span>
        <?php elseif (isset($errors['email'])) : ?>
          <span class="warning">Invalid email address</span>
      <?php endif; ?>
    </label>
    <input type="email" name="email" id="email"
        <?php 
        if($errors || $missing){
          echo 'value="' .htmlentities($email) .'"'; 
        }
        ?>
    >
  </p>
  <p>
    <label for="comments">Comments:
      <?php if ($missing && in_array('comments', $missing)) : ?>
        <span class="warning">You forgot to add any comments</span>
      <?php endif; ?>
    </label>
    <textarea name="comments" id="comments">
      <?php
      if($errors || $missing){
        echo htmlentities($comments); 
      }
      ?>
    </textarea>
  </p>
  <p>
    <input type="submit" name="send" id="send" value="Send Comments">
  </p>
</form>
<pre>
    <?php
   /* if ($_POST && $mailSent) {
      echo "Message: \n\n";
      echo htmlentities($message);
      echo "Headers: \n\n";
      echo htmlentities($headers);
    }

    if ($_GET) {
        echo 'Content of the $_GET array:<br>';
        print_r($_GET);
    } elseif ($_POST) {
        echo 'Content of the $_POST array:<br>';
        print_r($_POST);
    }
    */
    ?>
</pre>
</body>
</html>