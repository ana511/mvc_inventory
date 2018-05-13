<div class="signin">
  <h1>Sign in</h1>
  <form method="POST" action="index.php?page=authentication&action=signin">
    <div class="field">
      <label>Username:</label>
      <input type="text" name="username" required>
    </div>
    <div class="field">
      <label>Password:</label>
      <input type="password" name="password" required>
    </div>
    <div>
      <input type="hidden" name="csrf" value="<?php echo $_SESSION['token']?>">
    </div>
    <input class="btn" type="submit" name="form_submitted">
  </form>
</div>