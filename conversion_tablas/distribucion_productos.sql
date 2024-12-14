INSERT INTO fraschina_2024.distribucion_productos (
    id,
    distribucion_id,
    producto_id,
    precio,
    fecha,
    nomproducto,
    fechaUEnt,
    status,
    created_at,
    updated_at
)
SELECT
    IdProCli AS id,
    Idcliente AS distribucion_id,
    Idproducto AS producto_id,
    CASE
        WHEN precio REGEXP '^[0-9]+(\.[0-9]+)?$' THEN CAST(precio AS FLOAT)
        ELSE NULL
    END AS precio, -- Convertir solo valores válidos
    fechaprecio AS fecha,
    nomProd AS nomproducto,
    fechaUEnt,
    'A' AS status,  -- Asignar estado activo por defecto
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.productoporclientedist
WHERE
    IdProCli IS NOT NULL; -- Evitar registros nulos en la clave primaria
