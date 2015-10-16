<form action="." method="post">
{if count($errors)}
<ul>
{foreach from=$errors item=error}
<li>error:<font color="#ff0000">{$error}</font></li>
{/foreach}
</ul>
{/if}
<table border="0">
<tr>
<td>comment here</td>
</tr>
<tr>
<td>
<textarea cols="50" rows="10" name="comment">{$form.comment}</textarea>
</td>
</table>
<p>
<input type="submit" name="action_comment_do" value="SUBMIT">
</p>
</form>




