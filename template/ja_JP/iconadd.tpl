current icon:<br>
<img src="{$app.iconurl}">
<br>
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




