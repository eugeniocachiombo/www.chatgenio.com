<header>
        <div class="container w-100 d-table">
                <div class="col d-flex">
                        <div class="col text-start">
                                <img class="img-fluid" width="100px" src="../../assets/img/icones/logo.png" alt="">
                        </div>
        
                        <div class="col  text-end d-flex justify-content-end align-items-center">
                                <p id="slogan" style="">Génio Pró Chat</p>
                        </div>
                </div>
                <?php if(!empty($_SESSION["nome"])){ ?>
                        <div class="col text-start pt-4">
                        <p id="nome_sessao" > <i class="fas fa-user" 
                        style="border-radius: 30px;border-bottom: 2px solid white; border-top: 2px solid white;padding: 8px; "></i> 
                        <span id="sessao"><?php echo ucwords($_SESSION["nome"]); ?> </span> </p>
                        </div>
                <?php } ?>
        </div>
</header>