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
<td>old password </td>
<td><input type="password" name="oldpass" value="{$form.oldpass}"></td>
<tr>
<td>new password</td>
<td><input type="password" name="newpass" value=""></td>
</tr>
</table>
<p>
<input type="submit" name="action_changepass_do" value="CHANGE!!!">
</p>
</form>