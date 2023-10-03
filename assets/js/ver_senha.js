var fechado = document.querySelector('.aberto');
		var aberto = document.querySelector('.fechado');
		var senha = document.querySelector('.senha');
		aberto.style = "display: none;"

	function verSenhar(){
			if (senha.type == "password") {

				aberto.style = "display: inline;"
				fechado.style = "display: none;"
				senha.type = "text"
			} else if (senha.type == "text"){

				aberto.style = "display: none;"
				fechado.style = "display: inline;"

				senha.type = "password"
			}
		}