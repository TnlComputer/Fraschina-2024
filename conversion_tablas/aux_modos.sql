INSERT INTO fraschina_2024.auxmodos (id, nombre, created_at, updated_at)
SELECT 
    Idmodo AS id,
    nomModo AS nombre,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxmodo;
