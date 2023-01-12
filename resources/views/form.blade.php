<form action="unicode" method="post">
    <input type="text" name="fullname">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
    <input type="hidden" name="_method" value="patch">
    <button type="submit">Submit</button>
</form>

<a target="_blank" href="<?php echo route('admin.tintuc',['id'=>123,'slug'=>'dung-dan']) ?>">Duong dan</a>