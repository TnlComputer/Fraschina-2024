INSERT INTO fraschina_2024.auxareas (id, area, created_at, updated_at)
SELECT 
    Idarea AS id,
    Area AS area,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxareas;
