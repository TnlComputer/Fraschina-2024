    INSERT INTO fraschina_2024.agro_productos (
    id,
    agro_id,
    producto_id,
    status,
    created_at,
    updated_at
)
SELECT
    IdProAgro AS id,
    Idagro AS agro_id,
    Idproducto AS producto_id,
    'A' AS status,  -- Asignar un valor constante para el campo 'status', por ejemplo, 'A' (activo)
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha y hora actual para updated_at
FROM fraschin_backup.productoporagro
WHERE
    IdProAgro IS NOT NULL;  -- Asegurarse de que 'IdProAgro' no sea nulo
