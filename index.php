<?php require('./cookie.php'); ?>

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <title>Registrace a přihlášení</title>
    </head>
    <body>

        <!-- Pokud existuje zprava v session, vypise ji -->
        <?php if($_SESSION['message']): ?>

            <div>
                <p><strong><?php echo $_SESSION['message']; ?></strong></p>
            </div>

            <?php unset($_SESSION['message']); ?>

        <?php endif; ?>

        <!-- Pokud je uzivatel prihlaseny, uvidi jiny obsah -->
        <?php if ($_SESSION['logged_in']): ?>

            <div>

                <h1>Přihlášen jako <?php echo $_SESSION['email']; ?></h1>

                <form name="logout" action="logout.php" method="post">

                    <button type="submit" name="submit">Odhlásit</button>

                </form>

            </div>

        <!-- Pokud neni, uvidi registraci a prihlaseni -->
        <?php else: ?>

            <div>

                <h1>Registrace</h1>

                <form name="registration" action="registration.php" method="post">

                    <input type="email" name="email" placeholder="E-mail" required>
                    <br>

                    <input type="password" name="password" placeholder="Heslo" required>
                    <br>

                    <button type="submit" name="submit">Registrovat</button>

                </form>

            </div>

            <div>

                <h1>Přihlášení</h1>

                <form action="login.php" name="login" method="post">

                    <input type="email" name="email" placeholder="E-mail" required>
                    <br>

                    <input type="password" name="password" placeholder="Heslo" required>
                    <br>

                    <p>
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Zapamatovat přihlášení</label>
                    </p>

                    <button type="submit" name="submit">Přihlásit</button>

                </form>

            </div>

        <?php endif; ?>

    </body>
</html>