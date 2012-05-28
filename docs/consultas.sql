/* Todos los paises */
SELECT * 
FROM countries;

/* Paises que empiezan por Au */
SELECT *
FROM countries
WHERE country LIKE 'Au%';

/* Id de los paises que empiezan por An */
SELECT idcountries
FROM countries
WHERE country LIKE 'An%';

/* Nombre de los paises que terminan en n */
SELECT country
FROM countries
WHERE country LIKE '%n';

/* Con ALIAS Nombre de los paises que terminan en n */
SELECT country AS 'nombre del pais'
FROM countries
WHERE country LIKE '%n';

/* Borrar el pais con id */
DELETE 
FROM countries
WHERE idcountries=2;

/* Insertar un pais */
INSERT INTO countries 
    SET country = 'Austria';

INSERT INTO countries
    VALUES ('Austria');
    
UPDATE countries
SET country='Argelia'
WHERE idcountries=9;
    
    