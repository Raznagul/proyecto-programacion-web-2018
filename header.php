<?php
echo '<header>
    <h1>'. $variables['title'] .'</h1>';

if (isset($variables['login']) && $variables['login']) {
    echo '<form method="post" action="router.php">
            <input type="submit" value="login" name="login">
          </form>';
}
if (isset($variables['logout']) && $variables['logout']) {
    echo '<form method="post" action="router.php">
            <input type="submit" value="logout" name="logout">
          </form>';
}
if (isset($variables['signup']) && $variables['signup']) {
    echo '<form method="post" action="router.php">
            <input type="submit" value="signup" name="signup">
          </form>';
}

echo '</header>';