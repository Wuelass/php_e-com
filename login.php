<?php include 'includes/header.php'; ?>

<div class="login-card">
        <form method="POST" action="/controllers/login.php">
            <label>Email</label>
            <input name="email" type="text" value=""/>
            <label>Password</label>
            <input name="password" type="password" value=""/>
            <input type="submit" value="submit"/>
        </form>
    </div>

<?php include 'includes/footer.php'; ?>