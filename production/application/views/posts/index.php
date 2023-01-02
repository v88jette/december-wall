<a href="/logout">Logout</a>

<h1>Posts</h1>
<form action="post" method="post" class="post_form">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <textarea name="content" placeholder="Post something"e></textarea>
    <input type="submit" value="Post">
</form>
<?php 
if (!$posts['status']){
    $post['result'] = [];
}

foreach($posts['result'] as $post){ ?>
<p class="post"><span><?= $post['author']; ?></span> says <span><?= $post['content']; ?></span> at <span><?= $post['created_at']; ?></span></p>

<?php if ($post['user_id'] === $this->session->userdata('user_id')){ ?>
<form action="delete_post" method="post" class="delete_form delete_post_form">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
    <input type="submit" value="Delete">
</form>
<?php } ?>
<form action="reply" method="post" class="reply_form">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
    <textarea name="content" placeholder="Reply something"></textarea>
    <input type="submit" value="Reply">
</form>
<?php 
if ($post['replies'] == null){
    $replies = [];
}else{
    $replies = explode(',', $post['replies']);
}

foreach($replies as $reply){
    $reply = explode('~~~', $reply);
?>
<p class="reply"><span><?= $reply[0]; ?></span> says <span><?= $reply[1]; ?></span> at <span><?= $reply[2]; ?></span></p>
<?php if ($reply[4]  === $this->session->userdata('user_id')){ ?>
    <form action="delete_reply" method="post" class="delete_form delete_reply_form">
    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
    <input type="hidden" name="reply_id" value="<?= $reply[3]; ?>">
    <input type="submit" value="Delete">
</form>
<?php } 
    }
} ?>