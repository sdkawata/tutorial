  <h2>Index Page</h2>
  <p>Welcome to Ethnam!</p>
{if $app.logined}
{$app.username}-san, Good Morning.<a href="?action_logout=true"> log out </a>
<a href="?action_userlist=true">user list</a>
<a href="?action_changepass=true">change password</a>
{else}
<a href="?action_login=true"> log in</a>
<a href="?action_signup=true"> sign up</a>
{/if}

