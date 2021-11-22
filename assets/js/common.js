/**
 * @author Christian S Barbosa
 */


jQuery(document).ready(function() {

    jQuery(document).on("click", ".deleteUser", function() {
        var userId = $(this).data("userid"),
            hitURL = baseURL + "deleteUser",
            currentRow = $(this);

        var confirmation = confirm("Tem certeza em apagar este usuário ?");

        if (confirmation) {
            jQuery.ajax({
                type: "POST",
                dataType: "json",
                url: hitURL,
                data: { userId: userId }
            }).done(function(data) {
                console.log(data);
                currentRow.parents('tr').remove();
                if (data.status = true) { alert("Usuario excluído com sucesso."); } else if (data.status = false) { alert("Falha ao apagar o usuário"); } else { alert("Acesso Negado..!"); }
            });
        }
    });


    jQuery(document).on("click", ".searchList", function() {

    });

});