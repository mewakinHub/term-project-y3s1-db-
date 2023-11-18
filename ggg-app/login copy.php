<!DOCTYPE html>
<html lang="en">
<head>
  <!--Defaults-->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GGG</title>
  <link rel="icon" href="asset/logo.png">
  <link rel="stylesheet" href="style/global.css">
  <link rel="stylesheet" href="style/variables.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <!--Custom-->
  <link rel="stylesheet" href="style/landing.css">
  <?php include_once('script/icon.php'); ?>
</head>
<body>
  <div class='root landing'>
    <main>
      <div class='login-container'>
        <img class='center logofull' alt='logofull' src="asset/logofull.png" style="max-width: 200px; height: auto;"/>
        <span class='message-container'>
          <p>Hello! Please log in.</p>
        </span>
        <form autoComplete='off' onSubmit={handleSubmit}>
          <div class='inputicon-container email'>
            <input type='text' onChange={handleChange} required name='email' placeholder='E-mail' maxLength='64' class='iconned'/>
            <?php Icon('mail') ?>
          </div>
          <div class='inputicon-container password'>
            <input type='password' onChange={handleChange} required name='password' placeholder='Password' maxLength='64' class='iconned'/>
            <?php Icon('key') ?>
          </div>
          <div type='submit' class='button-wrapper' >
            <button class='default full white'>Enter</button>
          </div>
        </form>
        <div class='button-container'>
            <div class='button-wrapper'>
              <button type="button" class='default noaccount'>Sign up</button>
            </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>