# GameApp

### Atividade
> Esta atividade tem como objetivo exercitar o desenvolvimento de aplicações com PHP e HTML+Javascript. 

> Para isto deve ser acrescentada na aplicação usada como exemplo nas semanas anteriores (gamesApp) a funcionalidade Fórum, que consiste em permitir que o usuário envie mensagens para o fórum da aplicação. 

> Deve ser apresentada na aplicação a tabela Fórum (além das tabelas de usuários e jogos que já aparecem). 
 
> Esta tabela Fórum deve apresentar o remetente da mensagem, o título e o corpo da mensagem. Na aplicação, a escolha do remetente deve ser feita via seleção a partir dos usuários já cadastrados. 

> A figura a seguir ilustra a aparência desta funcionalidade na aplicação. Não é necessário implementar a deleção de mensagens do fórum. 

> No banco games já existe uma tabela fórum com a estrutura necessária para esta funcionalidade.


### Get Started
> assets, backend, db folders contain the relevant files to each part of the project

### Development
##### db
> create a DB on your mysql and import the /db/games.sql
> configure backend/_config.php with your mysql creds

##### Running
> to serve the project on (http://localhost:8888) run the command below on the project folder
```bash
    php -S 127.0.0.1:8888
```