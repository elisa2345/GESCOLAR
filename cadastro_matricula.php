<?php
if(isset($_REQUEST['cadastrar']))
{ 
    try
{
    include 'includes/conexao.php';

    $stmt_alunos = $conexao-> prepare ("SELECT * FROM aluno ORDER BY nome ASC");
    $stmt_alunos -> execute();

    
    $stmt_turmas = $conexao-> prepare ("SELECT * FROM turma");
    $stmt_turmas -> execute();

    if(isset($_REQUEST['cadastrar']))
{
    $sql = "INSERT INTO matricula (id_turma,id_aluno,data_matricula)
                     values (?,?,NOW())";
   
    $stmt = $conexao-> prepare($sql);
    $stmt->bindParam(1,$_REQUEST['id_turma']);
    $stmt->bindParam(2,$_REQUEST['id_aluno']);
    $stmt->execute();

    echo "Matricula realizada com sucesso!";

}

} catch(Exception $e){
    echo $e-> getMessasge();
}
}
?>
<link href ="css/estilos.css" type="text/css" rel="stylesheet"/>
<?php include_once ' includes/cabecalho.php'?>

<div>
<fieldset> 
 <legend>Nova Matricula</legend>
 <form action ="cadastro_matricula.php?cadastrar=true"method="post">
 <label>
                <select name = "id_turma">
                <?php while ($turma = $stmt_turmas -> fetchObject()): ?>
                    <option value= "<?= $turma->id ?>"> <?= $turma->descricao ?> </option>
            <?php endwhile?>
    </select>
</label>
  <label>
                <select name = "id_aluno">
                <?php while ($aluno = $stmt_aluno -> fetchObject()): ?>
                      <option value= "<?= $aluno->id ?>"> <?=$aluno->descricao?> </option>
            <?php endwhile?>
    </select>
</label>
        <button type="submit">Salvar Matrícula</button>
             </form>
       </legend>
    </fieldset>
    </div>