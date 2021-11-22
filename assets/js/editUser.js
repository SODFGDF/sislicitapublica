/**
 * File : editUser.js 
 * 
 * This file contain the validation of edit user form
 * 
 * @author Kishor Mali
 */
$(document).ready(function() {

    var editUserForm = $("#editUser");

    var validator = editUserForm.validate({

        rules: {
            fname: { required: true },
            login: { required: true },
            email: { required: true, email: true, remote: { url: baseURL + "checkEmailExists", type: "post", data: { userId: function() { return $("#userId").val(); } } } },
            cpassword: { equalTo: "#password" },
            mobile: { required: true, digits: true },
            role: { required: true, selected: true }
        },
        messages: {
            fname: { required: "Este campo é obrigatório" },
            login: { required: "Este campo é obrigatório" },
            email: {
                required: "Este campo é obrigatório",
                mail: "Por favor entre com um campo de email valido",
                remote: "E-mail ja existe"
            },
            cpassword: { required: "Este campo é obrigatório", equalTo: "Entre com a mesmo valor de senha" },
            
            role: { required: "Este campo é obrigatório", selected: "Por favor selecione uma opção" }
        }
    });

    var editProfileForm = $("#editProfile");

    var validator = editProfileForm.validate({

        rules: {
            fname: { required: true },
            mobile: { required: true, digits: true },
            email: { required: true, email: true, remote: { url: baseURL + "checkEmailExists", type: "post", data: { userId: function() { return $("#userId").val(); } } } },
        },
        messages: {
            fname: { required: "Este campo é obrigatório" },
            
            email: { required: "Este campo é obrigatório", email: "Please enter valid email address", remote: "Email already taken" },
        }
    });

});