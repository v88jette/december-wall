<form action="/process_signup" method="post">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
    <input type="text" name="form[fname]" placeholder="Enter first name">
    <input type="text" name="form[lname]" placeholder="Enter last name">
    <input type="text" name="form[email]" placeholder="Enter email address">
    <input type="password" name="form[password]" placeholder="Enter password">
    <input type="password" name="form[confirm_password]" placeholder="Enter confirm password">
    <input type="submit" value="Sign up">
    <a href="/login">Login here</a>
</form>