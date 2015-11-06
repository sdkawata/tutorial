{$app.userid}'s page<br>
current icon:<br>
<img src="{$app.iconurl}">
<br>
<!--
{if $app.ismypage}
<form action="/" method="post" enctype="multipart/form-data">
{if count($errors)}
<ul>
{foreach from=$errors item=error}
<li>error:<font color="#ff0000">{$error}</font></li>
{/foreach}
</ul>
{/if}
<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
Use this icon:<input type="file" name="userfile">
<br>
<input type="submit" name="action_iconadd_do" value="UPLOAD ICON">
</form>
{/if}
<br>
-->
User's post:
<br>


{foreach from=$app.posts item=item}
<table bordercolor="#333333" cellpadding="5">
<tr><td>
submitted by {$item.userid}
<img src="{$item.iconurl}" width=64>
{if $item.submittime!==NULL}
at {$item.submittime}
{/if}
</td></tr>
<tr><td>
<font color="{$item.color}">{$item.content|nl2br}</font>
{if $item.fileurl!==NULL}
<img src="{$item.fileurl}" width="200">
</td></tr>
{/if}
</table>
{/foreach}






