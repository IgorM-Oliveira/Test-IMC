CREATE DATABASE per;

\c per;

CREATE TYPE status_usuario AS ENUM ('create','remove_red_eye','clear');
CREATE TYPE tipo_usuario AS ENUM ('supervisor_account','person');

CREATE TABLE usuarios (
  id SERIAL PRIMARY KEY,
  nome VARCHAR(200) NOT NULL,
  rgm VARCHAR(20) NOT NULL,
  usuario VARCHAR(20) NOT NULL,
  senha VARCHAR(255) NOT NULL,
  status status_usuario NOT NULL,
  tipo tipo_usuario NOT NULL,
  administrador BOOLEAN NOT NULL,
  created TIMESTAMP,
  modified TIMESTAMP,
  UNIQUE (rgm),
  UNIQUE (usuario)
);

CREATE TYPE status_perguntas AS ENUM ('done','timer','clear');

CREATE TABLE perguntas (
  id SERIAL PRIMARY KEY,
  pergunta TEXT NOT NULL,
  status status_perguntas NOT NULL,
  usuario_id INT NOT NULL,
  created TIMESTAMP,
  modified TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TYPE status_resposta AS ENUM ('done','timer','clear');

CREATE TABLE respostas (
  id SERIAL PRIMARY KEY,
  resposta TEXT NOT NULL,
  status status_resposta NOT NULL,
  usuario_id INT NOT NULL,
  pergunta_id INT NOT NULL,
  created TIMESTAMP,
  modified TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (pergunta_id) REFERENCES perguntas(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE classificacoes (
  id SERIAL PRIMARY KEY,
  classificacao INT NOT NULL,
  usuario_id INT NOT NULL,
  resposta_id INT NOT NULL,
  created TIMESTAMP,
  modified TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (resposta_id) REFERENCES respostas(id) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE avaliacoes (
  id SERIAL PRIMARY KEY,
  justificativa TEXT NOT NULL,
  usuario_id INT NOT NULL,
  pergunta_id INT DEFAULT NULL,
  resposta_id INT DEFAULT NULL,
  created TIMESTAMP,
  modified TIMESTAMP,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (pergunta_id) REFERENCES perguntas(id) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (resposta_id) REFERENCES respostas(id) ON DELETE CASCADE ON UPDATE CASCADE
);


INSERT INTO usuarios (nome, rgm, usuario, senha, status, tipo, administrador, created, modified)
VALUES
('Felipe Pereira Perez', '46763', 'fpp', '$2y$10$WCaapTjKoIl/eVciYlVS8uGj.75sKv6eKCfUnN1Eg.kZY11BiWp0e', 'create', 'supervisor_account', TRUE, NOW(), NOW()),
('Sharlene Thomas', '46764', 'st', '$2y$10$WCaapTjKoIl/eVciYlVS8uGj.75sKv6eKCfUnN1Eg.kZY11BiWp0e', 'create', 'person', FALSE, NOW(), NOW()),
('Miguel Correia', '46765', 'mc', '$2y$10$WCaapTjKoIl/eVciYlVS8uGj.75sKv6eKCfUnN1Eg.kZY11BiWp0e', 'remove_red_eye', 'person', FALSE, NOW(), NOW()),
('João Vitor', '46766', 'jv', '$2y$10$WCaapTjKoIl/eVciYlVS8uGj.75sKv6eKCfUnN1Eg.kZY11BiWp0e', 'create', 'person', FALSE, NOW(), NOW());

INSERT INTO perguntas (pergunta, status, usuario_id, created, modified)
VALUES
('O que é PHP SESSION?', 'done', 1, NOW(), NOW()),
('O que é PHP SESSION?', 'clear', 1, NOW(), NOW()),
('Como eu faço para utilizar o $_GET?', 'done', 1, NOW(), NOW());

INSERT INTO respostas (resposta, status, usuario_id, pergunta_id, created, modified)
VALUES
('Session é uma variável global do PHP', 'done', 1, 1,  NOW(), NOW()),
('Session é uma variável global do PHP', 'clear', 1, 1,  NOW(), NOW()),
('É uma variavel global que pode ser acessada por todas páginas do PHP, desde que a sessão esteja aberta.', 'done', 1, 1,  NOW(), NOW()),
('Você deve utilizar como uma variável global', 'clear', 1, 1,  NOW(), NOW()),
('Para você utilizar a variável global $_GET você pode acessar ela diretamente por uma chave.', 'done', 1, 3,  NOW(), NOW());

INSERT INTO avaliacoes (justificativa, usuario_id, pergunta_id, resposta_id, created, modified)
VALUES
('Resposta Repetida', 1, NULL, 2, NOW(), NOW()),
('Pergunta Repetida', 1, 1, NULL, NOW(), NOW()),
('Informação incompleta.', 1, NULL, 4, NOW(), NOW());

INSERT INTO classificacoes (classificacao, usuario_id, resposta_id, created, modified)
VALUES
(1, 1, 1, NOW(), NOW()),
(1, 1, 3, NOW(), NOW()),
(1, 1, 5, NOW(), NOW()),
(5, 3, 1, NOW(), NOW()),
(1, 3, 5, NOW(), NOW()),
(1, 3, 3, NOW(), NOW());


