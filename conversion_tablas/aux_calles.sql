INSERT INTO fraschina_2024.auxcalles (id, calle, created_at, updated_at)
SELECT 
    id_Calle AS id,
    nombre_calle AS calle,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.calles;
