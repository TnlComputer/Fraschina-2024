INSERT INTO fraschina_2024.auxestados (id, nomEstado, created_at, updated_at)
SELECT 
    id_estado AS id,
    estado AS nomEstado,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxestados;
