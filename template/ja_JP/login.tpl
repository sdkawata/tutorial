<form action="." method="post">

{if count($errors)}
<ul>
{foreach from=$errors item=error}
<div class="alert alert-danger">
<strong>error</strong>:{$error}
</div>
{/foreach}
</ul>
{/if}

<form role="form">
<div class="form-group">
<label for="id">ID:</label>
<input type="id" class="form-control" placeholder="Enter your ID" value="{$form.mailaddress}" name="mailaddress">
</div>
<div class="form-group">
<label for="pwd">Password:</label>
<input type="password" name="password" class="form-control" placeholder="Enter your password" value="">
</div>
<button type="submit" class="btn btn-default" name="action_login_do" value="LOGIN">LOG IN</button>
</form>

<!--
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
<input type="submit" name="action_login_do" value="LOG IN">
</p>
</form>
-->