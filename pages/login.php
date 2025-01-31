<main>
    <section class="gradient-start">
        <div class="welcome">
            <h2>Login to your account</h2>
        </div>
    </section>
    <section class="pagecontent">
        <div class="logingrid">
            <div class="logingriditem"></div>
            <div class="logingriditem">
                <div class="signin">
                    <form action="code/Signin.php" method="POST" class="loginform">
                        <label for="username">Username:</label><br>
                        <input type="text" id="username" name="username" required><br><br>
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password" required><br><br>
                        <button type="submit" class="loginbtn">Login</button>
                    </form>
                    <div class='registerlink'>
                        <span>Not a user yet? </span><a href='index.php?page=register'> Register here ➤➤➤</a>
                    </div>
                </div>
            </div>
            <div class="logingriditem"></div>
        </div>    
    </section>
    <section class="gradient-end">
    </section>
</main>