<?php

class Usuario
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    // CADASTRAR USUÁRIO
    public function cadastrar($nome, $cpf, $email, $senha)
    {
        $Comando = $this->conexao->prepare(
            "INSERT INTO TB_USUARIO
            (
                NOME_USUARIO,
                CPF_USUARIO,
                EMAIL_USUARIO,
                SENHA_USUARIO
            )
            VALUES (?, ?, ?, ?)"
        );

        $Comando->bindParam(1, $nome);
        $Comando->bindParam(2, $cpf);
        $Comando->bindParam(3, $email);
        $Comando->bindParam(4, $senha);

        return $Comando->execute();
    }

    // LOGIN
    public function login($email, $senha)
    {
        $Comando = $this->conexao->prepare(
            "SELECT * FROM TB_USUARIO
            WHERE EMAIL_USUARIO = ?
            AND SENHA_USUARIO = ?"
        );

        $Comando->bindParam(1, $email);
        $Comando->bindParam(2, $senha);

        $Comando->execute();

        return $Comando;
    }

    // ALTERAR USUÁRIO
    public function alterar($id, $nome, $email)
    {
        $Comando = $this->conexao->prepare(
            "UPDATE TB_USUARIO
            SET
            NOME_USUARIO = ?,
            EMAIL_USUARIO = ?
            WHERE ID_USUARIO = ?"
        );

        $Comando->bindParam(1, $nome);
        $Comando->bindParam(2, $email);
        $Comando->bindParam(3, $id);

        return $Comando->execute();
    }

    // BUSCAR USUÁRIO
    public function buscar($id)
    {
        $Comando = $this->conexao->prepare(
            "SELECT * FROM TB_USUARIO
            WHERE ID_USUARIO = ?"
        );

        $Comando->bindParam(1, $id);

        $Comando->execute();

        return $Comando->fetch(PDO::FETCH_OBJ);
    }
}

?>