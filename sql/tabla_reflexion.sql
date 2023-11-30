CREATE TABLE Reflexion (
   id TINYINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
   titulo VARCHAR(50) NOT NULL,
   contenido VARCHAR(255) NOT NULL,
   nivel_id INT, -- He tenido que usar INT a la fuerza ya que mis compañeros usaron INT para este campo en la otra tabla , tendría más sentido un TINYINT UNSIGNED ya que no va a haber tantos niveles
   CONSTRAINT reflexion_nivel FOREIGN KEY (nivel_id) REFERENCES Nivel(id),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
