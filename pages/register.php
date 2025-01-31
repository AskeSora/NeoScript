<main>
    <section class="gradient-start">
        <div class="welcome">
            <h2>Register new account</h2>
        </div>
    </section>
    <section class="pagecontent">
        <div class="logingrid">
            <div class="logingriditem"></div>
            <div class="logingriditem">
                <div class="signin">
                    <form action="code/Signup.php" method="POST" class="loginform">
                        <label for="username">Username:</label><br>
                        <input type="text" id="username" name="username" required><br><br>
                        <label for="password">Password:</label><br>
                        <input type="password" id="password" name="password" required><br><br>
                        <label for='confirm_password'>Confirm Password:</label><br>
                        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                        <button type="submit" class="loginbtn">Register</button>
                    </form>
                    <div class='registerlink'>
                        <span>Already a user? </span><a href='index.php?page=login'> Login here ➤➤➤</a>
                    </div>
                </div>
            </div>
            <div class="logingriditem"></div>
        </div>    
    </section>
    <section class="gradient-end">
    </section>
</main>