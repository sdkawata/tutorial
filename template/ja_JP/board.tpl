<h2>Board</h2>

{if count($errors)}
<ul>
{foreach from=$errors item=error}
<li>error:<font color="#ff0000">{$error}</font></li>
{/foreach}
</ul>
{/if}

{* {$app.board|@var_dump} *}

{foreach from=$app.board item=item}
<table bordercolor="#333333" cellpadding="5">
<tr><td>
{$item.username}
{if $item.time!==NULL}
 {$item.time}
{/if}
</td></tr>
<tr><td>
{$item.text}
</td></tr>
</table>
{/foreach}
<form action="." method="post">
<textarea cols="50" rows="10" name="text">{$form.text}</textarea>
</form>