INSERT INTO fraschina_2024.transporte_personal (
    id,               -- ID principal
    nombre,           -- Nombre del personal
    apellido,         -- Apellido del personal
    transporte_id,    -- Relación con transporte
    area_id,          -- Relación con área
    cargo_id,         -- Relación con cargo
    categoriacargo_id,-- Relación con categoría de cargo
    teldirecto,       -- Teléfono directo
    interno,          -- Extensión interna
    telcelular,       -- Teléfono celular
    profesion_id,     -- Relación con profesión
    telparticular,    -- Teléfono particular
    email,            -- Correo electrónico
    observaciones,    -- Observaciones (información adicional)
    fuera,            -- Indicador de fuera
    status,           -- Estado del registro
    created_at,       -- Fecha de creación
    updated_at        -- Fecha de actualización
)
SELECT
    Ipersona AS id,                  -- ID principal
    Nombre AS nombre,                -- Nombre
    Apellido AS apellido,            -- Apellido
    Idtransporte AS transporte_id,   -- Relación con transporte
    Idarea AS area_id,               -- Relación con área
    Idcargo AS cargo_id,             -- Relación con cargo
    cate_cargo AS categoriacargo_id, -- Relación con categoría de cargo
    TelDirecto AS teldirecto,        -- Teléfono directo
    Interno AS interno,              -- Extensión interna
    TelCelular AS telcelular,        -- Teléfono celular
    Idprofesion AS profesion_id,     -- Relación con profesión
    Telparticular AS telparticular,  -- Teléfono particular
    Mail AS email,                   -- Correo electrónico
    INFOparticular AS observaciones, -- Observaciones
    IF(fuera = '1', 1, 0) AS fuera,  -- Convertir fuera de varchar a tinyint
    'A' AS status,                   -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at, -- Fecha actual como created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha actual como updated_at
FROM fraschin_backup.personaltransportes
WHERE Ipersona IS NOT NULL;          -- Asegurar que el ID no sea nulo
    -- Asegurar que el ID no sea nulo
