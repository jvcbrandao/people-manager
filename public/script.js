onload = () => {
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
                        <button class="btnPrimario">Editar</button>
                        <button class="btnTerciario">Excluir</button>

                      </td>
                    </tr>
    `;
      })
    );
};

document
  .getElementById("cadastrarUsuario")
  .addEventListener("submit", salvarUsuario);





  
function salvarUsuario(e) {
  e.preventDefault();

  let nome = document.getElementById("nome").value;
  let cpf = document.getElementById("cpf").value;
  let idade = document.getElementById("idade").value;
  let messageContainer = document.getElementById("messageContainer");
  fetch("http://localhost:8000/api/pessoas.php", {
    method: "POST",
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
    })
    .catch((err) => {
      messageContainer.innerHTML = `<p class="msgErro">Erro: ${err}</p>`;
    });
}
