<?php

class Pedido
{
    private $conexao;

    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }

    // CADASTRAR PEDIDO
    public function cadastrarPedido(
        $idUsuario,
        $banco,
        $conta,
        $capital,
        $taxa,
        $tempo,
        $rendimento,
        $total
    )
    {
        $Comando = $this->conexao->prepare(
            "INSERT INTO TB_PEDIDO
            (
                ID_USUARIO,
                BANCO_PEDIDO,
                CONTA_PEDIDO,
                CAPITAL_PEDIDO,
                TAXA_PEDIDO,
                TEMPO_PEDIDO,
                RENDIMENTO_PEDIDO,
                TOTAL_PEDIDO
            )
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $Comando->bindParam(1, $idUsuario);
        $Comando->bindParam(2, $banco);
        $Comando->bindParam(3, $conta);
        $Comando->bindParam(4, $capital);
        $Comando->bindParam(5, $taxa);
        $Comando->bindParam(6, $tempo);
        $Comando->bindParam(7, $rendimento);
        $Comando->bindParam(8, $total);

        return $Comando->execute();
    }

    // LISTAR PEDIDOS
    public function listarPedidos($idUsuario)
    {
        $Comando = $this->conexao->prepare(
            "SELECT * FROM TB_PEDIDO
            WHERE ID_USUARIO = ?"
        );

        $Comando->bindParam(1, $idUsuario);

        $Comando->execute();

        return $Comando;
    }
}

?>