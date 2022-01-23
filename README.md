# ApControle
Olá Sejam bem vindos Esse é um projeto para o #AP.coders abaixo está os requisistos e os passos para funcionar o projeto.

Para esse projeto vai precisar ter em sua máquina os seguintes programas XAMPP Control Panel MySQL Workbench 8.0 CE IDE de sua preferencia

Baixe o projeto e inclua dentro da pasta C:\xampp\htdocs

inicie o XAMPP Control Panel click em START em frente do Apache e MySQL

Inicie MySQL Workbench 8.0 CE e execute os seguintes scripts

CREATE SCHEMA apcontrole ;

CREATE TABLE apcontrole.despesa ( id BIGINT(20) NOT NULL AUTO_INCREMENT, descricao_desp VARCHAR(200) NULL, tipo_desp VARCHAR(200) NULL, valor_desp DECIMAL(9,2) NULL, vencimento_desp DATE NULL, status_desp VARCHAR(45) NULL, propi_unid VARCHAR(200) NULL, PRIMARY KEY (id));

CREATE TABLE apcontrole.inquilino ( id BIGINT(20) NOT NULL AUTO_INCREMENT, nome_inq VARCHAR(200) NULL, idade_inq INT(11) NULL, telefone_inq INT(11) NULL, email_inq VARCHAR(200) NULL, sexo_inq VARCHAR(45) NULL, PRIMARY KEY (id));

CREATE TABLE apcontrole.inquilino ( id BIGINT(20) NOT NULL AUTO_INCREMENT, proprietario_unid VARCHAR(200) NULL, condominio_unid INT(11) NULL, endereco_unid VARCHAR(500) NULL, PRIMARY KEY (id));

Após criação do banco de dados pode iniciar o projeto em um navegador(preferencia Google chrome) atráves do local host, o site é todo intuitivo

Agradeço a todos e espero que seja útil para outros fins.
