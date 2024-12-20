INSERT INTO fraschina_2024.auxbarrios (id, nombrebarrio, created_at, updated_at)
SELECT 
    Idbarrio AS id,
    NomBarrio AS nombrebarrio,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxbarrio;
