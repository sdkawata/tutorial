<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script type="text/javascript" src="showiconurl.js"></script>
<h2>User List</h2>

{if count($errors)}
<ul>
{foreach from=$errors item=error}
<li>error:<font color="#ff0000">{$error}</font></li>
{/foreach}
</ul>
{/if}

<table bordercolor="#333333" cellpadding="5">
size:{$app.listsize}
{foreach from=$app.userlist item=item}
<tr>
<td class="userId">{$item.id}</td>
<td>{$item.passwd}</td>
<td>
<form action="." method="post">
<input type="hidden" name="mailaddress" value="{$item.id}">
<input type="submit" name="action_delete" value="DELETE!">
</form>
</td>
<td>
<input class="iconUrlButton" data-id="{$item.id}" type="button" value="show icon url">
</td>
</td>
</tr>
{/foreach}
</table>

<a href=".">Home</a>

