create database dbTCC;

use dbTCC;

create table tblUsuario(
	idUsuario int primary key auto_increment,
    nomeUsuario varchar(150) not null,
    sobrenomeUsuario varchar(150) not null,
    emailUsuario varchar(200) not null,
    senhaUsuario varchar(150) not null,
    dataUsuario datetime not null
);
	
create table tblDadosCompra(
	idCompra int primary key auto_increment not null,
    nomeCompra varchar(30) not null,
    dataCompra date not null,
    horarioCompra time not null,
    precoCompra double not null,
    vencimentoCompra date not null,
    idUsuario int not null,
    constraint fk_idUsuario foreign key (idUsuario) references tblUsuario(idUsuario)
);

set @data = current_date();

insert into tblDadosCompra(nomeCompra, dataCompra, horarioCompra, precoCompra, vencimentoCompra, idUsuario)
values ('Pamonha', current_date(), current_time(), 3.50, date_add(current_date(), interval 1 month), 2);

select * from tblDadosCompra;
select * from tblUsuario;

select emailUsuario, senhaUsuario from tblUsuario;

insert into tblUsuario(nomeUsuario, emailUsuario, senhaUsuario, dataUsuario, sobrenomeUsuario)
values('jubicledson', 'email@email.com', '123456', now(), 'da silva a assaouro');

select count(*) as total from tblUsuario where emailUsuario = 'eullerttt@gmail.com';
 
alter table tblDadosCompra change VencimentoCompra vencimentoCompra date not null;
drop table tblDadosCompra;
drop table tblUsuario;

ALTER TABLE tblUsuario ADD sobrenomeUsuario varchar(200) not null;

UPDATE tblDadosCompra SET horarioCompra = date_add(@data, interval 2 month) WHERE idCompra = 4 AND idUsuario = 2;

UPDATE tblDadosCompra SET precoCompra = 2.5 WHERE idCompra = 3 AND idUsuario = 2;

UPDATE tblUsuario SET sobrenomeUsuario = 'da silva n sei o q' WHERE idUsuario = 2;

SELECT MIN(vencimentoCompra) FROM tblDadosCompra WHERE idUsuario = 2;