<html>
<head> 
  <title>Add a Captcha!</title>
</head>
<body>
  <h1>Adding a captcha</h1>
  <p>Take a look at <code style="background:rgb(220,220,220);">application/controllers/login.php</code> to look at the 
      controller used to generate the captcha.</p>
  
  <?php echo validation_errors(); ?>
  
  <?php echo form_open('login'); ?>
  
  <p>
    <label for="name">Name:
      <input id="name" name="name" type="text" />
    </label>
  </p>
  
  <?php echo $cap['image']; ?>
  
  <p>
    <label for="name">Captcha:
      <input type="text"   id="captcha" name="captcha" />
    </label>
  </p>
  
  <?php echo form_submit("submit", "Submit"); ?>
  
  <?php echo form_close(); ?>
  
</body>
</html>
