<?php
  include 'header.php';
  include 'navbar.php';
  include 'topMenu.php';
?>

<main style="max-width: 480px; margin: 50px auto;">
  <h2 style="text-align:center; margin-bottom: 20px;">Create Account</h2>

    <?php if(isset($_GET['error'])): ?>
        <div style="margin:10px 0; color:red;"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
    <?php if(isset($_GET['msg'])): ?>
        <div style="margin:10px 0; color:green;"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

  <form action="processSignup.php" method="post" autocomplete="off">
    <div style="margin-bottom: 15px;">
      <label for="username">Username:</label><br>
      <input id="username" name="username" required
             style="width:100%; padding:8px; box-sizing:border-box;">
    </div>

    <div style="margin-bottom: 15px;">
      <label for="email">Email:</label><br>
      <input type="email" id="email" name="email" required
             style="width:100%; padding:8px; box-sizing:border-box;">
    </div>

    <div style="margin-bottom: 15px;">
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password" required
             style="width:100%; padding:8px; box-sizing:border-box;">
    </div>

    <div style="margin-bottom: 20px;">
      <label for="confirm_password">Confirm Password:</label><br>
      <input type="password" id="confirm_password" name="confirm_password" required
             style="width:100%; padding:8px; box-sizing:border-box;">
    </div>

    <div style="text-align:center;">
      <button type="submit" name="signup" value="1" style="padding:10px 20px;">Sign up</button>
    </div>
  </form>

  <p style="text-align:center; margin-top:15px;">
    Already have an account? <a href="login.php">Log in</a>
  </p>
</main>

<?php include 'footer.php'; ?>
