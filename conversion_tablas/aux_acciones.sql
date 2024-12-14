INSERT INTO fraschina_2024.auxacciones (
    id,
    accion,
    colorAcc,
    colorCod,
    status,
    created_at,
    updated_at
)
SELECT
    id_accion AS id,
    accion,
    color_Acc AS colorAcc,
    cod_color AS colorCod,
    'A' AS status,  -- Asignar un valor constante para 'status', por ejemplo, 'A' (activo)
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxaccion
WHERE 
    id_accion IS NOT NULL;  -- Asegurarse de que 'id_accion' no sea nulo
