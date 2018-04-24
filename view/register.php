<div class="register">
  <h1>Register</h1>
  <form method="POST" action="index.php?page=authentication&action=register">
    <div class="field">
      <label>Name:</label>
      <input type="text" name="name">
    </div>
    <div class="field">
      <label>Email:</label>
      <input type="email" name="email">
    </div>
    <div class="field">
      <label>Username:</label>
      <input type="text" name="username" required>
    </div>
    <div class="field">
      <label>Password:</label>
      <input type="password" name="password" required>
    </div>
    <div class="field">
      <label>Password Confirmation:</label>
      <input type="password" name="passwordconfirmation">
    </div>
    <div>
      <input type="hidden" name="csrf" value="<?php echo $_SESSION['token']?>">
    </div>
    <input type="submit" name="form_submitted">
  </form>
  <p>
    If you already have an account, click <a href="index.php?page=authentication&action=signin">here</a>
  </p>
</div>