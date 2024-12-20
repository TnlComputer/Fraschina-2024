INSERT INTO fraschina_2024.auxtipopersonal (id, tipo, created_at, updated_at)
SELECT 
    id_tp AS id,
    tipo_tp AS tipo,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxtipopers;
