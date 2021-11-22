/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Christian da Silva Barbosa
 */

$(document).ready(function() {

    var addUserForm = $("#addUser");

    var validator = addUserForm.validate({

        rules: {
            fname: { required: true },
            login: { required: true },
            email: { required: true, email: true, remote: { url: baseURL + "checkEmailExists", type: "post" } },
            password: { required: true },
            cpassword: { required: true, equalTo: "#password" },
            
            role: { required: true, selected: true }
        },
        messages: {
            fname: { required: "Este campo é obrigatório" },
            login: { required: "Este campo é obrigatório" },
            email: {
                required: "Este campo é obrigatório",
                email: "Por favor entre com um campo de email valido",
                remote: "E-mail ja existe"
            },
            password: { required: "Este campo é obrigatório" },
            cpassword: { required: "Este campo é obrigatório", equalTo: "Entre com a mesmo valor de senha" },
            
            role: { required: "Este campo é obrigatório", selected: "Por favor selecione uma opção" }
        }
    });
});