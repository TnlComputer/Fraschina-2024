-- ============================================
-- MIGRACIÓN: productoporclientedist → distribucion_productos
-- ============================================

-- Desactivar temporalmente las claves foráneas
SET foreign_key_checks = 0;

-- Guardar y desactivar temporalmente el modo estricto
SET @OLD_SQL_MODE = @@sql_mode;

SET sql_mode = '';

INSERT INTO
    fraschina_2024.distribucion_productos (
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
    -- Clave primaria
    CAST(IdProCli AS UNSIGNED) AS id,

-- Distribución
CAST(Idcliente AS UNSIGNED) AS distribucion_id,

-- Producto
CAST(Idproducto AS UNSIGNED) AS producto_id,

-- Precio convertido de texto a número
CASE
        WHEN TRIM(precio) REGEXP '^[0-9]+([.,][0-9]+)?$'
        THEN REPLACE(precio, ',', '.') + 0
        ELSE NULL
    END AS precio,

-- Limpieza de fechaprecio (tratado como texto)
CASE
    WHEN CAST(fechaprecio AS CHAR) IN ('0000-00-00', '', 'NULL') THEN NULL
    ELSE STR_TO_DATE(fechaprecio, '%Y-%m-%d')
END AS fecha,

-- Nombre del producto
nomProd AS nomproducto,

-- Limpieza de fechaUEnt
CASE
    WHEN CAST(fechaUEnt AS CHAR) IN ('0000-00-00', '', 'NULL') THEN NULL
    ELSE STR_TO_DATE(fechaUEnt, '%Y-%m-%d')
END AS fechaUEnt,

-- Estado
'A' AS status,

-- Fechas de creación/actualización
CURRENT_TIMESTAMP AS created_at,
CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.productoporclientedist
WHERE
    IdProCli IS NOT NULL;

-- Restaurar modo estricto
SET sql_mode = @OLD_SQL_MODE;

-- Reactivar comprobaciones de claves foráneas
SET foreign_key_checks = 1;