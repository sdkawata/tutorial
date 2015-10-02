  <h2>User List</h2>
<table bordercolor="#333333" cellpadding="5">
size:{$app.listsize}
{foreach from=$app.userlist item=item}
<tr>
<td>{$item.id}</td>
<td>{$item.passwd}</td>
</tr>
{/foreach}
</table>

