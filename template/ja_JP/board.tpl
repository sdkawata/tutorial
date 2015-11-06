<h2>Board</h2>


{* {$app.board|@var_dump} *}

{foreach from=$app.posts item=item}
<table bordercolor="#333333" cellpadding="5">
<tr><td>
submitted by 
<a href=/?action_userpage=true&userid={$item.userid}>{$item.userid}</a>
<img src="{$item.iconurl}" width=64>
{if $item.submittime!==NULL}
at {$item.submittime}
{/if}
<form action="." method="post">
<input type="hidden" name="id" value="{$item.id}">
<input type="submit" name="action_board_delete" value="DELETE">
</form>
</td></tr>
<tr><td>
<font color="{$item.color}">{$item.content|nl2br}</font>
{if $item.fileurl!==NULL}
<img src="{$item.fileurl}" width="200">
</td></tr>
{/if}
</table>
{/foreach}

{if $app.hasprev}
<a href='{$app.link}&start=0'>start</a>&nbsp;
<a href='{$app.link}&start={$app.prev}'>&lt;&lt;</a>
{else}
start&nbsp;&lt;&lt;
{/if}
&nbsp;
{foreach from=$app.pager item=page}
{if $page.offset==$app.current}
<strong>{$page.index}</strong>
{else}
<a href="{$app.link}&start={$page.offset}">{$page.index}</a>
{/if}
&nbsp;
{/foreach}
{if $app.hasnext}
<a href="{$app.link}&start={$app.next}">&gt;&gt;</a>&nbsp;
<a href="{$app.link}&start={$app.last}">last</a>
{else}
&gt;&gt;&nbsp;last
{/if}
{if count($errors)}
<ul>
{foreach from=$errors item=error}
<li>error:<font color="#ff0000">{$error}</font></li>
{/foreach}
</ul>
{/if}

<form action="." method="post" enctype="multipart/form-data">
<textarea cols="50" rows="10" name="content">{$form.text}</textarea>
<input type="hidden" name="MAX_FILE_SIZE" value="100000000000">
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
