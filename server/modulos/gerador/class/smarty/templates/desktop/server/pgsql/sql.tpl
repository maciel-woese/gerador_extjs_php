
CREATE TABLE modulos
(
  modulo character varying(45),
  descricao character varying(45),
  id serial NOT NULL,
  CONSTRAINT pk_id PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);



INSERT INTO `modulos` (`id`, `modulo`,`descricao`) VALUES {foreach from=$menu item=field name=foo2}({$smarty.foreach.foo2.index+1}, '{$field}','{$field|capitalize}');{/foreach} 
INSERT INTO `modulos` (`id`, `modulo`,`descricao`) VALUES ({$smarty.foreach.foo2.index+2}, 'perfil', 'Perfil');
INSERT INTO `modulos` (`id`, `modulo`,`descricao`) VALUES ({$smarty.foreach.foo2.index+2}, 'usuarios', 'Usuarios');
  
CREATE TABLE modulos_acoes
(
  id serial NOT NULL,
  acao character varying(45),
  acao_desc character varying(45),
  modulo_id integer,
  CONSTRAINT pk_modulos_acoes_id PRIMARY KEY (id),
  CONSTRAINT fk_modulos_acoes_modulo_id FOREIGN KEY (modulo_id)
      REFERENCES modulos (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);


{foreach from=$menu item=field name=foo3}
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('listar', 	{$smarty.foreach.foo3.index+1}, 'Listar');
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('adicionar', 	{$smarty.foreach.foo3.index+1}, 'Adicionar');
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('editar', 	{$smarty.foreach.foo3.index+1}, 'Editar');
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('deletar', 	{$smarty.foreach.foo3.index+1}, 'Deletar');
{/foreach} 
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('deletar', 	{$smarty.foreach.foo3.index+1}, 'Deletar');('listar', 	{$smarty.foreach.foo3.index+2}, 'Listar'),
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('adicionar', 	{$smarty.foreach.foo3.index+2}, 'Adicionar'),
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('editar', 	{$smarty.foreach.foo3.index+2}, 'Editar'),
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('deletar', 	{$smarty.foreach.foo3.index+2}, 'Deletar'),
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('modulos',	{$smarty.foreach.foo3.index+2},	'Add. Modulos'),
 
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('listar', 	{$smarty.foreach.foo3.index+3}, 'Listar'),
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('adicionar', 	{$smarty.foreach.foo3.index+3}, 'Adicionar'),
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('editar', 	{$smarty.foreach.foo3.index+3}, 'Editar'),
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('deletar', 	{$smarty.foreach.foo3.index+3}, 'Deletar'),
INSERT INTO `modulos_acoes` (`acao`,`modulo_id`, `acao_desc`) VALUES ('modulos',	{$smarty.foreach.foo3.index+3},	'Add. Modulos'); 
 
CREATE TABLE perfil
(
  id serial NOT NULL,
  perfil character varying(45),
  CONSTRAINT pk_perfil_id PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);



INSERT INTO `perfil` (`id`,`perfil`) VALUES 
 (1, 'Administrador');

 
 
CREATE TABLE usuarios
(
  id serial NOT NULL,
  nome character varying(45),
  perfil_id integer,
  email character varying(70),
  login character varying(45),
  senha character varying(32),
  administrador character varying(1),
  status character varying(1),
  CONSTRAINT pk_usuarios_id PRIMARY KEY (id),
  CONSTRAINT fk_usuarios_perfil_id FOREIGN KEY (perfil_id)
      REFERENCES perfil (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT check_administrador_usuarios CHECK (administrador::text = ANY (ARRAY['1'::text, '2'::text])),
  CONSTRAINT check_status_usuarios CHECK (status::text = ANY (ARRAY['1'::text, '2'::text]))
)
WITH (
  OIDS=FALSE
);


INSERT INTO `usuarios` (`nome`, `perfil_id`, `email`, `login`, `senha`, `administrador`) VALUES 
 ('Administrador', 1, 'admin@admin.com.br', 'admin', md5('admin'), '1');

 
 
CREATE TABLE permissoes_perfil
(
  id serial NOT NULL,
  perfil_id integer,
  acao_id integer,
  CONSTRAINT pk_permissoes_perfil_id PRIMARY KEY (id),
  CONSTRAINT "FK_permissoes_perfil_acao_id" FOREIGN KEY (acao_id)
      REFERENCES modulos_acoes (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT "FK_permissoes_perfil_perfil_id" FOREIGN KEY (perfil_id)
      REFERENCES perfil (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);



CREATE TABLE permissoes_usuario
(
  id serial NOT NULL,
  usuario_id integer,
  acao_id integer,
  acesso character varying(1),
  CONSTRAINT pk_permissoes_usuario_1 PRIMARY KEY (id),
  CONSTRAINT "FK_permissoes_usuario_1" FOREIGN KEY (usuario_id)
      REFERENCES usuarios (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT "FK_permissoes_usuario_2" FOREIGN KEY (acao_id)
      REFERENCES modulos_acoes (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT check_acesso_permissoes_usuario CHECK (acesso::text = ANY (ARRAY['S'::text, 'N'::text]))
)
WITH (
  OIDS=FALSE
);


