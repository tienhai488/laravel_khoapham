<h1>Them chuyen muc</h1>
<form action="<?php echo route('categories.add') ?>" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token() ?>">
    <input type="hidden" name="_method" value="post">
    <input type="text" name="name" placeholder="Nhap ten danh muc">

    <br>
    <button type="submit">Them Danh Muc</button>
</form>