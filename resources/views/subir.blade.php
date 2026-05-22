<form action="/subir-imagen" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="imagen">
    <button type="submit">Subir imagen</button>
</form>