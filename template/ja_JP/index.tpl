  <h2>Index Page</h2>
  <p>Welcome to Ethnam!</p>
{if $app.logined}
{$app.username}-san, Good Morning.<a href="?action_logout=true"> log out </a>
{else}
<a href="?action_login=true"> log in</a>
{/if}

