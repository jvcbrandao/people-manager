onload = () => {
  listarPessoas();
};

let editId = null;

const listBtnExcluir = document.getElementsByClassName("btnExcluir");

document
  .getElementById("cadastrarUsuario")
  .addEventListener("submit", salvarUsuario);

function listarPessoas() {
  const bodyTable = document.getElementById("bodyTable");
  fetch("http://localhost:8000/api/pessoas.php", {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) =>
      data.map((d) => {
        bodyTable.innerHTML += `
                    <tr>
                      <td>${d.id}</td>
                      <td>${d.nome}</td>
                      <td>${d.cpf}</td>
                      <td>${d.idade}</td>
                      <td>${d.data_criacao}</td>
                      <td>
                        <button class="btnPrimario btnEditar"  data-id="${d.id}"
                         aria-label="Editar usuário ${d.id}">Editar</button>
                        <button class="btnTerciario btnExcluir" 
                        aria-label="Excluir usuário ${d.id}" data-id="${d.id}">
                          Excluir
                        </button>
                      </td>
                    </tr>
    `;
      })
    );
}

function salvarUsuario(e) {
  e.preventDefault();
  let nome = document.getElementById("nome").value;
  let cpf = document.getElementById("cpf").value;
  let idade = document.getElementById("idade").value;
  let messageContainer = document.getElementById("messageContainer");

  const url = editId
    ? `http://localhost:8000/api/pessoas.php?id=${editId}`
    : "http://localhost:8000/api/pessoas.php";

  const method = editId ? "PUT" : "POST";

  fetch(url, {
    method: method,
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      nome: nome,
      cpf: cpf,
      idade: idade,
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.message) {
        messageContainer.innerHTML = `<p class="msgSucesso">${data.message}</p>`;
      } else if (data.error) {
        messageContainer.innerHTML = `<p class="msgErro">${data.error}</p>`;
      } else {
        messageContainer.innerHTML = `<p class="msgErro">Resposta inesperada do servidor.</p>`;
      }

      document.getElementById("cadastrarUsuario").reset();
      editId = null;
      bodyTable.innerHTML = "";

      const salvarBtn = document.getElementById("salvarInfo");
      if (salvarBtn) {
        salvarBtn.textContent = "Salvar";
      }
      listarPessoas();
    })
    .catch((err) => {
      messageContainer.innerHTML = `<p class="msgErro">Erro: ${err}</p>`;
    });
}

const bodyTable = document.getElementById("bodyTable");

bodyTable.addEventListener("click", function (e) {
  if (e.target.classList.contains("btnExcluir")) {
    const id = e.target.dataset.id; // pega o data-id
    excluirUsuario(id, e.target);
  }

  if (e.target.classList.contains("btnEditar")) {
    const id = e.target.dataset.id; // pega o data-id
    editarUsuario(id, e.target);
  }
});

function excluirUsuario(id, botao) {
  if (!confirm("Tem certeza que deseja excluir este usuário?")) return;

  fetch(`http://localhost:8000/api/pessoas.php?id=${id}`, {
    method: "DELETE",
  })
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
      const linha = botao.closest("tr");
      linha.remove();
    })
    .catch((err) => {
      console.error("Erro ao excluir:", err);
      alert("Não foi possível excluir o usuário.");
    });
}

function listarPessoa(id) {
  let nome = document.getElementById("nome");
  let cpf = document.getElementById("cpf");
  let idade = document.getElementById("idade");
  const bodyTable = document.getElementById("bodyTable");
  fetch(`http://localhost:8000/api/pessoas.php?id=${id}`, {
    method: "GET",
  })
    .then((response) => response.json())
    .then((data) => {
      nome.value = data.nome;
      cpf.value = data.cpf;
      idade.value = data.idade;
    });
}

function editarUsuario(id, botao) {
  editId = id;
  listarPessoa(id);

  const salvarBtn = document.getElementById("salvarInfo");
  if (salvarBtn) {
    salvarBtn.textContent = "Atualizar";
  }

}

// const pesquisarCpf = document.getElementById('pesquisarCPF');
// pesquisarCpf.addEventListener('click', pesquisarCpf)

// function pesquisarCpf(){

// cpf = pesquisarCpf.value;


// }
