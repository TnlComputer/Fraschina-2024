INSERT INTO fraschina_2024.auxcontacto (id, contacto, created_at, updated_at)
SELECT 
    Idcontacto AS id,
    Contacto AS contacto,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxcontacto;
