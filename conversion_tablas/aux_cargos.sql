INSERT INTO fraschina_2024.auxcargos (id, cargo, categoria_id, created_at, updated_at)
SELECT 
    Idcargo AS id,
    Cargos AS cargo,
    CAST(cate AS UNSIGNED) AS categoria_id,  -- Se asume que 'cate' es un número, y lo convertimos a tipo bigint
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxcargos;
