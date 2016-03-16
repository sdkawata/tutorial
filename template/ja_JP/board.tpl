<h2>Board</h2>


{* {$app.board|@var_dump} *}

<div class="container">
<div class="panel-group">

{foreach from=$app.posts item=item}
<div class="panel panel-info">
<div class="panel-heading">
submitted by 
<a href=/?action_userpage=true&userid={$item.userid}>{$item.userid}</a>
<img src="{$item.iconurl}" class="img-rounded" width=64>
{if $item.submittime!==NULL}
at {$item.submittime}
{/if}
<form action="." method="post">
<input type="hidden" name="id" value="{$item.id}">
<button type="submit" name="action_board_delete" class="btn btn-danger" value="true">
DELETE<span class="glyphicon glyphicon-remove"></span>
</button>
</form>
</div>
<div class="panel-body">
<font color="{$item.color}">{$item.content|nl2br}</font>
{if $item.fileurl!==NULL}
<a href="{$item.fileurl}">
<img src="{$item.fileurl}" class="img-rounded img-responsive">
</a>
{/if}
</div>
</div>
{/foreach}

</div>
</div>

<!-- pager -->
<ul class="pager">
{if $app.hasprev}
<a href='{$app.link}&start=0'>start</a>&nbsp;
<a href='{$app.link}&start={$app.prev}'><li class="previous">&lt;&lt;</li></a>
{else}
start&nbsp;&lt;&lt;
{/if}
&nbsp;

<ul class="pagination">
{foreach from=$app.pager item=page}
{if $page.offset==$app.current}
<li class="active"><a>{$page.index}</a></li>
{else}
<li><a href="{$app.link}&start={$page.offset}">{$page.index}</a></li>
{/if}
&nbsp;
{/foreach}
</ul>

{if $app.hasnext}
<a href="{$app.link}&start={$app.next}"><li class="next">&gt;&gt;</li></a>&nbsp;
<a href="{$app.link}&start={$app.last}">last</a>
{else}
&gt;&gt;&nbsp;last
{/if}
</ul>
{if count($errors)}
<ul>
{foreach from=$errors item=error}
<div class="alert alert-danger">
<strong>error</strong>:{$error}
</div>
{/foreach}
</ul>
{/if}

<form action="." method="post" enctype="multipart/form-data">
<textarea class="form-control" cols="50" rows="10" name="content">{$form.text}</textarea>
<input type="hidden" name="MAX_FILE_SIZE" value="100000000000">
<input type="hidden" id="uploaded-fileid" name="uploaded-fileid" value="">
<input class="btn btn-primary btn-large" type="submit" name="action_board_do" value="POST">
<br>
color:
<select name="color">
<option value="#000000" style="color:#000000">black</option>
<option value="#ff0000" style="color:#ff0000">red</option>
<option value="#00ff00" style="color:#00ff00">green</option>
<option value="#0000ff" style="color:#0000ff">blue</option>
</select>
</form>

<!-- S3Signer -->
<script src="/uploader.js"></script>
<script src="/board_uploader.js"></script>
<input type="file" id="files" name="files[]" style="display:none"/>
<div class="input-group">
<input type="text" id="filepath" class="form-control" placeholder="select file...">
<span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="$('input[id=files]').click()">Upload</button></span>
</div>
<div id="status"></div>

<br>


