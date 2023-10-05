<?php

if(empty($_SESSION["nome"])){
	?>
		<script>
			window.location = "../index";
		</script>
	<?php
}