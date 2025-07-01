<?php 
class Produto {
    private $nome;
    private $preco;
    private $pdo;

    // Construtor opcional com nome e preço
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // Setters
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    // Getters
    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    // Inserir produto no banco
    public function criar($nome, $preco) {
        if (empty($nome) || !is_numeric($preco)) {
            return false;
        }

        $novoUser = $this->pdo->prepare("INSERT INTO tbprod (nome, preco) VALUES (:nome, :preco)");
        return $novoUser->execute([':nome' => $nome, ':preco' => $preco]);
    }

    public function listarTodos() {
        $busca = $this->pdo->query("SELECT * FROM tbprod");
        return $busca->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $buscaId = $this->pdo->prepare("SELECT * FROM tbprod WHERE id = :id");
        $buscaId->execute([':id' => $id]);
        return $buscaId->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar($id, $nome, $preco) {
        $update = $this->pdo->prepare("UPDATE tbprod SET nome = :nome, preco = :preco WHERE id = :id");
        return $update->execute([':nome' => $nome, ':preco' => $preco, ':id' => $id]);
    }

    public function deletar($id) {
        $destroy = $this->pdo->prepare("DELETE FROM tbprod WHERE id = :id");
        return $destroy->execute([':id' => $id]);
    }
}
