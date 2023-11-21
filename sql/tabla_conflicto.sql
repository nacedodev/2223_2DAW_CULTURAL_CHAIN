CREATE TABLE Conflicto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreconflicto VARCHAR(100) NOT NULL,
    posx smallint NOT NULL,
    posy smallint NOT NULL,
    imagenconflicto smallint NOT NULL,
    estadoconflicto VARCHAR(50),
    nivel_id INT,
    CONSTRAINT fk_nombre_nivel 
        FOREIGN KEY (nivel_id) 
        REFERENCES Nivel(id) 
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;