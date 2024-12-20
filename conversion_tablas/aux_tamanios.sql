INSERT INTO fraschina_2024.auxtamanio (id, nombre, created_at, updated_at)
SELECT 
    Idtamanio AS id,
    nomTama AS nombre,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxtamanio;
