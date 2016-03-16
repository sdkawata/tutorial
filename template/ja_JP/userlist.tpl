<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script type="text/javascript" src="userlist.js"></script>
<h2>User List</h2>

{if count($errors)}
<ul>
{foreach from=$errors item=error}
<li>error:<font color="#ff0000">{$error}</font></li>
{/foreach}
</ul>
{/if}

<table bordercolor="#333333" cellpadding="5" id="userList" class="table-stripped">
{foreach from=$app.userlist item=item}
<tr>
<td class="userId">{$item.id}</td>
<td>{$item.passwd}</td>
<td>
<input type="button" class="deleteButton btn btn-primary" value="DELETE!">
</td>
<td>
<input class="iconUrlButton btn btn-primary" type="button" value="show icon url">
</td>
</td>
</tr>
{/foreach}
</table>

