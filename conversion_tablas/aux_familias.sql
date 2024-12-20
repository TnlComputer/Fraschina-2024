INSERT INTO fraschina_2024.auxfamilias (id, familia, created_at, updated_at)
SELECT 
    Idfamilia AS id,
    Familia AS familia,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxfamilia;
