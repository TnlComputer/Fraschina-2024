INSERT INTO fraschina_2024.auxaccion (id, accion, colorAcc, colorCod, status, created_at, updated_at)
SELECT 
    id_accion AS id,
    accion,
    color_Acc,
    cod_color,
    'A' AS status, -- Se asigna 'A' por defecto al campo status
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at  -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxaccion;
