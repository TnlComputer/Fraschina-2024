INSERT INTO fraschina_2024.auxorden (id, orden, created_at, updated_at)
SELECT 
    idOrden AS id,
    orden AS orden,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxorden;

