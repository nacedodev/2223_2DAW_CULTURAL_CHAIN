CREATE TABLE Clase (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etapa VARCHAR(50) NOT NULL,
    clase VARCHAR(50) NOT NULL,
    centro_id INT,
    CONSTRAINT fk_nombre_centro FOREIGN KEY (centro_id) REFERENCES Centro(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
