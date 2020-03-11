<?php
// Controle da Interface
require_once('utils/utils.php');
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
if ($acao == "excluir") {

    if ($_SERVER['REQUEST_METHOD'] ==  'GET'){
      $formulario = file_get_contents('listaVeterinario.php');
        $sql = 'DELETE FROM veterinario WHERE id = :id';
        // prepara o comando para executar
        $comando = preparaComando($sql);
        $comando->bindParam(':id',$_GET['id']);
        // executar o $comando
        $veterinario = executaComando($comando)->fetch(); // pegando os dados do banco
      }
      header("Location: listaVeterinario.php");
    }
else{
  if ($_SERVER['REQUEST_METHOD'] ==  'GET'){
    $formulario = file_get_contents('veterinario.html');
    if (isset($_GET['id'])){
      $sql = 'SELECT * FROM veterinario WHERE id = :id';
      // prepara o comando para executar
      $comando = preparaComando($sql);
      $comando->bindParam(':id',$_GET['id']);
      // executar o $comando
      $veterinario = executaComando($comando)->fetch(); // pegando os dados do banco
      $formulario = preencherFormulario($formulario,$veterinario);
    }else{
      $formulario = str_replace('{nome}','',$formulario);
      $formulario = str_replace('{crmv}','',$formulario);
      $formulario = str_replace('{telefone}','',$formulario);
      $formulario = str_replace('{id}','',$formulario);
    }
    print($formulario);
  }else if ($_SERVER['REQUEST_METHOD'] ==  'POST'){
    if (isset($_POST['nome'])){
      //tratamento de dados para inserção
      $nome = $_POST['nome'];
      $crmv = $_POST['crmv'];
      $telefone = $_POST['telefone'];
      $id = $_POST['id'];
      if ($id > 0){
        // definir o comando que será executado no banco de dados
        $sql = 'UPDATE veterinario
                   SET nome = :nome, crmv = :crmv, telefone = :telefone
                 WHERE id = :id';
        // prepara o comando para executar
        $comando = preparaComando($sql);

        //vincular variáveis com os parâmetros do comando
        $comando->bindParam(':nome',$nome);
        $comando->bindParam(':crmv',$crmv);
        $comando->bindParam(':telefone',$telefone);
        $comando->bindParam(':id',$id);
        // executar o $comando
        executaComando($comando);
        echo "Cadastro atualizado com sucesso!";
        //header("refresh: 0.3;listaVeterinario.php");
      }else{
        // salvar cadastro no banco
        //move arquivo com upload feito
        $destino = 'fotos/'.$_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $destino);

        // definir o comando que será executado no banco de dados
        $sql = 'INSERT INTO veterinario (nome, crmv, telefone, foto)
                     VALUES (:nome,:crmv,:telefone, :foto)';
        // prepara o comando para executar
        $comando = preparaComando($sql);

        //vincular variáveis com os parâmetros do comando
        $comando->bindParam(':nome',$nome);
        $comando->bindParam(':crmv',$crmv);
        $comando->bindParam(':telefone',$telefone);
        $comando->bindParam(':foto',$destino);
        // executar o $comando
        executaComando($comando);
        echo "Cadastro efetuado com sucesso!";
        //header("refresh: 0.3;listaVeterinario.php");
      }
    }else{
      echo "Preencha todos os campos do formulário";
    }
  }
  }
 ?>
