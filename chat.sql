

CREATE TABLE `mensagem` (
  `codSms` int(11) NOT NULL,
  `emissor` int(50) DEFAULT NULL,
  `receptor` int(50) DEFAULT NULL,
  `texto` varchar(9000) DEFAULT NULL,
  `Enviante` varchar(50) NOT NULL,
  `Recebido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




ALTER TABLE `mensagem`
  ADD PRIMARY KEY (`codSms`);


ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `mensagem`
  MODIFY `codSms` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

