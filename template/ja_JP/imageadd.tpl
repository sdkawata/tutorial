<form action="." method="post" enctype="multipart/form-data">
{if count($errors)}
<ul>
{foreach from=$errors item=error}
<li>error:<font color="#ff0000">{$error}</font></li>
{/foreach}
</ul>
{/if}
<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
Upload this file:<input type="file" name="userfile">
<br>
<input type="submit" name="action_imageadd_do" value="UPLOAD FILE">
</form>




