{if $app.logined}

<div class="container">
<div class="row">
<div class "col-xs-12 outline">
<h1>
{$app.username}-san, Good Morning.</h1>
</div>

<a href="?action_logout=true" class="btn btn-primary">logout</a>
<a href="?action_userlist=true" class="btn btn-primary">user list</a>
 
<a href="?action_changepass=true" class="btn btn-primary">change password</a>
 
<a href="?action_comment=true" class="btn btn-primary">send comment</a>
<a href="?action_imageadd=true" class="btn btn-primary"> upload image</a>
<a href="?action_board=true" class="btn btn-primary"> board</a>
<a href="?action_iconadd=true" class="btn btn-primary">iconadd</a>
{else}
<div class="container">
<div class="row">
<div class "col-xs-12 outline">
<h1>This is test page</h1>
</div>
<div class="row">
<div class="col-xs-6">
<div class="description">
If you have an ID, you can login.
<a href="?action_login=true" class="btn btn-primary"> log in</a>
</div>
</div>
<div class="col-xs-6">
<div class="description">
If you do not have an ID, you can sign up for <span class="emph">FREE</span>.
<a href="?action_signup=true" class="btn btn-primary"> sign up</a>
</div>
</div>
</div>
{/if}
<br>
today's picture
<br>
<img src=/uploaded/image.jpg>

