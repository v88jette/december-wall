<form action="/process_login" method="post">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <input type="text" name="form[email]" placeholder="Enter email address">
    <input type="password" name="form[password]" placeholder="Enter password">
    <input type="submit" value="Login">
    <a href="/signup">Register here</a>
</form>