<?php include 'header.php'; 
    include 'navbar.php'; 
    include 'topMenu.php'; ?>

<main style="max-width: 400px; margin: 50px auto;">
    <h2 style="text-align:center; margin-bottom: 20px;">Login</h2>

    <form action="processLogin.php" method="post">
        <div style="margin-bottom: 15px;">
            <label for="username">Username:</label><br>
            <input id="username" name="username" required style="width:100%; padding:8px; box-sizing:border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required style="width:100%; padding:8px; box-sizing:border-box;">
        </div>

        <div style="margin-bottom: 15px; display:flex; justify-content:space-between; align-items:center;">
            <label>
                <input type="checkbox" name="remember"> Remember me
            </label>
            <a href=#>Forgot password?</a>
        </div>

        <div style="text-align:center;">
            <button type="submit" name="submit" style="padding:10px 20px;">Login</button>
        </div>
    </form>

    <p style="text-align:center; margin-top:15px;">
        Don't have an account? <a href=#S>Sign up</a>
    </p>
</main>

<?php include 'footer.php'; ?>
