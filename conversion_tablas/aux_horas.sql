INSERT INTO fraschina_2024.auxhoras (id, hora, created_at, updated_at)
SELECT 
    IdHora AS id,
    hora AS hora,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxhora;
