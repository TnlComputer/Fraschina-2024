INSERT INTO fraschina_2024.auxprioridades (id, nombre, color, created_at, updated_at)
SELECT 
    id_prio AS id,
    nom_pri AS nombre,
    color_Prio AS color,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxprior;
