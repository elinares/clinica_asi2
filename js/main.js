//Deshabilitar doble clic en formularios
$("form").submit(function() {
    $(this).submit(function() {
        return false;
    });
    return true;
});