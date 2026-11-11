
-- CRUD Usuarios - Script de base de datos (MySQL / MariaDB)
-- Ejecutar completo en phpMyAdmin (pestaña SQL) o en la consola mysqlg

-- 1. CREAR BASE DE DATOS
DROP DATABASE IF EXISTS crud_usuarios;

CREATE DATABASE crud_usuarios
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE crud_usuarios;

-- 2. TABLA DE USUARIOS
-- El id es texto porque el dominio usa UserId como string.
-- role y status guardan los valores de UserRoleEnum / UserStatusEnum.
CREATE TABLE users (
                       id VARCHAR(36) NOT NULL PRIMARY KEY,
                       name VARCHAR(100) NOT NULL,
                       email VARCHAR(150) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL,
                       role VARCHAR(20) NOT NULL DEFAULT 'MEMBER',
                       status VARCHAR(20) NOT NULL DEFAULT 'PENDING',
                       created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                       updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                           ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. USUARIO ADMINISTRADOR BASE
-- Clave: Admin12345
INSERT INTO users (id, name, email, password, role, status)
VALUES (
           '1',
           'Administrador',
           'admin@crud.com',
           '$2y$10$bV10DYWy9QWVh4fJLhGlE.Wcl51osUGNWRM6l/N7bIy76Fkmr6i8m',
           'ADMIN',
           'ACTIVE'
       );


-- 4 TABLA DE ESTUDIANTES (ejercicio 1)
CREATE TABLE students (
                          id VARCHAR(36) NOT NULL PRIMARY KEY,
                          name VARCHAR(100) NOT NULL,
                          last_name VARCHAR(100) NOT NULL,
                          birth_date DATE NOT NULL,
                          semester TINYINT UNSIGNED NOT NULL,
                          email VARCHAR(150) NOT NULL UNIQUE,
                          gender VARCHAR(10) NOT NULL,
                          phone VARCHAR(20) NOT NULL,
                          program VARCHAR(100) NOT NULL,
                          university VARCHAR(150) NOT NULL,
                          created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                              ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

5. ESTUDIANTE DE EJEMPLO
INSERT INTO students (id, name, last_name, birth_date, semester, email, gender, phone, program, university)
VALUES ('1', 'Sebastian', 'Arango', '2003-05-17', 5, 'sebastian@universidad.edu.co',
        'MALE', '3001234567', 'Ingenieria de Sistemas', 'Universidad Ejemplo');

6. VERIFICACION
SELECT id, name, email, role, status, created_at FROM users;
SELECT id, name, last_name, semester, email, program FROM students;
