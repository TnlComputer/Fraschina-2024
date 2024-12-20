INSERT INTO fraschina_2024.auxtipopagos (id, nombre, created_at, updated_at)
SELECT 
    idTPagos AS id,
    nomTPago AS nombre,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxtpagos;
