  <h2>Sign Up</h2>
</ul>
<form action="." method="post">
{if count($errors)}
<ul>
{foreach from=$errors item=error}
<li>error:<font color="#ff0000">{$error}</font></li>
{/foreach}
</ul>
{/if}

<table border="0">
<tr>
<td>mail addr </td>
<td><input type="text" name="mailaddress" value="{$form.mailaddress}"></td>
<tr>
<td>password</td>
<td><input type="password" name="password" value=""></td>
</tr>
</table>
<p>
<input type="submit" name="action_signup_do" value="SIGN UP">
</p>
</form>






