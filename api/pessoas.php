<?php
header("Content-Type: application/json; charset=UTF-8");
require __DIR__ . '/cors.php';
require __DIR__ . '/config/db.php';

enable_cors();

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$data = json_decode(file_get_contents('php://input'), true);

try {
    switch ($method) {
        case 'GET':
            if ($id) {
                getPerson($conn, $id);
            } else {
                getPeople($conn);
            }
            break;

        case 'POST':
            testContent($data);
            createPerson($conn, $data);
            break;

        case 'PUT':
            if (!$id) {
                http_response_code(400);
                echo json_encode(["error" => "ID é obrigatório no método PUT"]);
                break;
            }
            testContent($data);
            editPerson($id, $data, $conn);
            break;

        case 'DELETE':
            if (!$id) {
                http_response_code(400);
                echo json_encode(["error" => "ID é obrigatório no método DELETE"]);
                break;
            }
            deletePerson($conn, $id);
            break;

        default:
            http_response_code(405);
            echo json_encode([
                "error" => "Método não permitido"
            ]);
            break;
    }

} catch (InvalidArgumentException $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "error" => "Erro interno no servidor"
    ]);
}


function getPerson(PDO $conn, int $id): void
{
    $stmt = $conn->prepare(
        "SELECT * FROM pessoas WHERE id = ?"
    );

    $stmt->execute([$id]);
    $pessoa = $stmt->fetch();

    if (!$pessoa) {
        http_response_code(404);
        echo json_encode([
            "message" => "Pessoa não encontrada"
        ]);
        return;
    }

    http_response_code(200);
    echo json_encode($pessoa);
}

function getPeople(PDO $conn)
{
    $stmt = $conn->query("SELECT * FROM pessoas");
    $pessoas = $stmt->fetchAll();
    echo json_encode($pessoas);
}

function createPerson(PDO $conn, array $data): void
{
    try {
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
            "id" => $conn->lastInsertId(),
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Erro ao criar pessoa"]);
    }
}

function editPerson(int $id, array $data, PDO $conn): void
{
    try {
        $stmt = $conn->prepare(
            "UPDATE pessoas
             SET nome = ?, cpf = ?, idade = ?
             WHERE id = ?"
        );

        $stmt->execute([
            $data["nome"],
            $data["cpf"],
            (int) $data["idade"],
            $id,
        ]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode([
                "message" => "Pessoa não encontrada para atualização"
            ]);
            return;
        }

        http_response_code(200);
        echo json_encode([
            "message" => "Pessoa editada com sucesso"
        ]);

    } catch (Exception $e) {
        error_log($e->getMessage());
        http_response_code(500);
        echo json_encode([
            "message" => "Não foi possível editar dados. Tente mais tarde."
        ]);
    }
}

function deletePerson(PDO $conn, int $id): void
{
    $stmt = $conn->prepare(
        "DELETE FROM pessoas WHERE id = ?"
    );

    $stmt->execute([$id]);

    if ($stmt->rowCount() === 0) {
        http_response_code(404);
        echo json_encode([
            "message" => "Pessoa não encontrada"
        ]);
        return;
    }

    http_response_code(200);
    echo json_encode([
        "message" => "Pessoa excluída com sucesso"
    ]);
}

function testContent(?array $data): void
{
    if (!$data || !isset($data['nome'], $data['cpf'], $data['idade'])) {
        throw new InvalidArgumentException("Campos obrigatórios: nome, cpf, idade.");
    }

    if (trim($data['nome']) === '' || trim($data['cpf']) === '') {
        throw new InvalidArgumentException("Nome e CPF não podem ser vazios.");
    }

    if (!is_numeric($data['idade'])) {
        throw new InvalidArgumentException("Idade deve ser numérica.");
    }
}
