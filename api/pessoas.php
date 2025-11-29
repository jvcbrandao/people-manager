<?php
header("Content-Type: application/json; charset=UTF-8");
require __DIR__ . '/config/db.php';
$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

try {

    switch ($method) {
        case 'GET':
            if ($id) {
                getPessoa($conn, $id);
            } else {
                getPessoas($conn);
            }
            break;
        case 'POST':
            createPessoa($conn);
            break;
    }


} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "error" => $e->getMessage()
    ]);
}

function getPessoa($conn, $id)
{
    $stmt = $conn->query("SELECT * FROM pessoas");
    $pessoas = $stmt->fetchAll();
    echo json_encode($pessoas);

}

function getPessoas($conn)
{
    $stmt = $conn->query("SELECT * FROM pessoas");
    $pessoas = $stmt->fetchAll();
    echo json_encode($pessoas);

}

function createPessoa($conn)
{

    
    $data = json_decode(file_get_contents('php://input'), true);
    //$id = isset($data['id']) ? (int)

    if (!isset($data['nome'],$data['cpf'],$data['idade'] )) {
        http_response_code(400);
        echo json_encode(["error" => "Campos obrigatórios: nome, cpf, idade "]);
        return;
    }

        $stmt = $conn->prepare(
        "INSERT INTO pessoas (nome, cpf, idade) VALUES (?, ?, ?)"
    );

    $stmt->execute([
        $data['nome'],
        $data['cpf'],
        (int) $data['idade'],
    ]);

    http_response_code(201);
    echo json_encode([
        "message" => "Pessoa criada com sucesso",
        "id"      => $conn->lastInsertId(),
    ]);


}