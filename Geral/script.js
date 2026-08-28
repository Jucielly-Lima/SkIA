// Seleciona o formulário
const formulario = document.querySelector(".cadastro-form");

// Seleciona os campos pelo ID
const Inome = document.querySelector("#nome");
const Iemail = document.querySelector("#email");
const Isenha = document.querySelector("#senha");
const Iusuario = document.querySelector("#usuario");

// Função de cadastro
function cadastrar() {

    fetch("http://localhost:8080/cadastrar", {

        headers: {
            "Accept": "application/json",
            "Content-Type": "application/json"
        },

        method: "POST",

        body: JSON.stringify({

            usuario: Iusuario.value,
            nome: Inome.value,
            email: Iemail.value,
            senha: Isenha.value

        })

    })

    .then(function(response) {

        if(response.ok){

            alert("Cadastro realizado com sucesso! 🎉");

            limpar();

        } else {

            alert("Erro ao cadastrar.");

        }

    })

    .catch(function(error){

        console.log(error);

        alert("Erro no servidor.");

    });

}

// Limpa os campos
function limpar(){

    Iusuario.value = "";
    Inome.value = "";
    Iemail.value = "";
    Isenha.value = "";

}

// Evento submit
formulario.addEventListener("submit", function(event){

    event.preventDefault();

    cadastrar();

});