// Dados dos contatos
const contatos = {
  Alexandre: "Atendimento ao cliente do Hotel Bom Pra Cachorro 🐶",
  Yago: "Responsável pelo desenvolvimento do sistema 💻",
  Lucas: "Cuidador especializado em pets 🐕",
  João: "Gerente geral do hotel 🏨"
};

function showContact(nome) {
  document.getElementById("modalName").innerText = nome;
  document.getElementById("modalInfo").innerText = contatos[nome];
  document.getElementById("modal").style.display = "flex";
}

function closeModal() {
  document.getElementById("modal").style.display = "none";
}

// Fechar clicando fora
window.onclick = function(event) {
  const modal = document.getElementById("modal");
  if (event.target === modal) {
    modal.style.display = "none";
  }
};