<section class="form">
    <div class="container">
        <h1 class="catalog-title" style="margin-bottom: 2rem">Registration form</h1>
        <form method="post" action="index.php">
            <p>Name</p>
            <label for="id1">
                <input type="text" name="name" id="id1" required placeholder="1-32 characters">
            </label>

            <p>Login</p>
            <label for="id2">
                <input type="text" name="newLogin" id="id2" required placeholder="3-32 characters">
            </label>

            <p>Password</p>
            <label for="id3">
                <input type="password" name="password" id="id3" required placeholder="3-32 characters">
            </label>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</section>