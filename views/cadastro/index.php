<?php
include '../inc/headHTML.php';
include '../inc/header.php';
//include '../../config/verificar_cookie.php';
?>

<title>Formulário de Cadastro</title>

<div class='container '>
    <main class='d-flex justify-content-center align-items-center'>
        <form method='POST' class="w-100">
            <center>
                <div class=''>
                    <div class="col pb-2">
                    <?php include '../../dao/_cadastroUsuario.php'; ?>
                    </div>

                    <div class='col-8 col-lg-5 pb-3 d-block justify-content-center align-items-center'>
                        <label class="text-start w-100" style="font-size: 40px; font-wight: bold; border-bottom: 2px solid white;">Cadastrar</label> 
                    </div>

                    <div class='col-8 col-lg-5 pb-3 d-block justify-content-center align-items-center'>
                        <label class="text-start w-100">Nome</label> <br>
                        <input class="form-control" id='campoNome' type='text' name='nome'
                            placeholder='Digite o seu nome'>
                    </div>

                    <div class='col-8 col-lg-5 pb-3 d-block justify-content-center align-items-center'>
                        <label class="text-start w-100">Código</label><br>
                        <input class="form-control" class='senha' id='campoCodigo' type='password' name='codigo'
                            placeholder='Digite o seu código'>
                    </div>

                    <div class='col-8 col-lg-5 pt-3'>
                        <input class="form-control" class='mb-3 btn' id='btnEntrar' type='submit' name='cadastrar'
                            value='Cadastrar'>
                    </div>

                    <div class='col-8 col-lg-5 pt-3'>
                        <input class="form-control" class="btn" id='btnCdastrar' type='submit' name='logar'
                            value='Logar'>
                    </div>

                </div>
            </center>
		</form>
	</main>
	<center>
	<p style="font-size: 15px"> 
		<span style='color: red;font-size: 15px'>Atenção:</span> 
		Por questões de segurança é bom anotar o
		seu Nome e o Código 
	</p>
	</center>
</div>

<?php
include '../inc/footer.html';
include '../inc/footHTML.html';
?>