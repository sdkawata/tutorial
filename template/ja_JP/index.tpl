  <h2>Index Page</h2>
  <p>Welcome to Ethnam!</p>
{if $app.logined}
{$app.username}-san, Good Morning.<a href="?action_logout=true"> log out </a>
<a href="?action_userlist=true">user list</a>
 
<a href="?action_changepass=true">change password</a>
 
<a href="?action_comment=true">send comment</a>
<a href="?action_imageadd=true"> upload image</a>
<a href="?action_board=true"> board</a>
<a href="?action_iconadd=true">iconadd</a>
{else}
<a href="?action_login=true"> log in</a>
<a href="?action_signup=true"> sign up</a>
{/if}
<br>
today's picture
<br>
<img src=/uploaded/image.jpg>

