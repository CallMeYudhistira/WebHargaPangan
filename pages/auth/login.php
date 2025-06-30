<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Log In</title>
  <link rel="stylesheet" href="pages/auth/assets/css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>
<body>
  <div class="login_form">
    <form action="pages/auth/actions/login.php" method="POST">
      <h3>Log in Panel</h3>
      <div class="login_cimahi">
        <img src="https://upload.wikimedia.org/wikipedia/commons/f/f6/Logo-Cimahi.png">
      </div>
      <p class="separator">
        <span>with</span>
      </p>
      <div class="input_box">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter email address" required autocomplete="off" />
      </div>
      <div class="input_box">
        <div class="password_title">
          <label for="password">Password</label>
        </div>
        <input type="password" name="password" id="password" placeholder="Enter your password" required autocomplete="off" />
      </div>
      <button type="submit">Log In</button>
      <p class="sign_up"><a href="#">©</a> 2025 CIMAHI. All rights reserved.</p>
    </form>
  </div>
</body>
</html>