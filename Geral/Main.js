const tabs = document.querySelectorAll(".tab");
const contents = document.querySelectorAll(".tab-content");

tabs.forEach(tab => {
  tab.addEventListener("click", () => {

    // remove active de tudo
    tabs.forEach(t => t.classList.remove("active"));
    contents.forEach(c => c.classList.remove("active"));

    // ativa botão clicado
    tab.classList.add("active");

    // pega o id
    const id = tab.getAttribute("data-tab");

    // ativa conteúdo correspondente
    document.getElementById(id).classList.add("active");

  });
});