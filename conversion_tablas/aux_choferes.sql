INSERT INTO fraschina_2024.auxchoferes (id, chofer, nombre, apellido, color, created_at, updated_at)
SELECT 
    idChofer AS id,
    chofer,
    nombre,
    apellido,
    color,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxchofer;
