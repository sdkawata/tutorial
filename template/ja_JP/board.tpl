<h2>Board</h2>


{* {$app.board|@var_dump} *}

{foreach from=$app.board item=item}
<table bordercolor="#333333" cellpadding="5">
<tr><td>
submitted by {$item.userid}
{if $item.submittime!==NULL}
at {$item.submittime}
{/if}
<form action="." method="post">
<input type="hidden" name="id" value="{$item.id}">
<input type="submit" name="action_board_delete" value="DELETE">
</form>
</td></tr>
<tr><td>
{$item.content}
</td></tr>
{if $item.filename!==NULL}
<tr><td>
<img src="/uploaded/{$item.filename}" width="200">
</td></tr>
{/if}
</table>
{/foreach}

{if count($errors)}
<ul>
{foreach from=$errors item=error}
<li>error:<font color="#ff0000">{$error}</font></li>
{/foreach}
</ul>
{/if}

<form action="." method="post" enctype="multipart/form-data">
<textarea cols="50" rows="10" name="content">{$form.text}</textarea>
<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
Upload this file:<input type="file" name="userfile">
<br>
color:
<select name="color">
<option value="#000000" style="color:#000000">black</option>
<option value="#ff0000" style="color:#ff0000">red</option>
<option value="#00ff00" style="color:#00ff00">green</option>
<option value="#0000ff" style="color:#0000ff">blue</option>
</select>
<br>
<input type="submit" name="action_board_do" value="SUBMIT">
</form>
