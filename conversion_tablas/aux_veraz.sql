INSERT INTO fraschina_2024.auxveraz (id, estado, color, created_at, updated_at)
SELECT 
    id_veraz AS id,
    veraz AS estado,
    color_Veraz AS color,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxveraz;
