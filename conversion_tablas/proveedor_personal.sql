INSERT INTO fraschina_2024.proveedor_personal (
    id,               -- ID principal
    nombre,           -- Nombre del personal
    apellido,         -- Apellido del personal
    proveedor_id,     -- Relación con proveedor
    area_id,          -- Relación con área
    cargo_id,         -- Relación con cargo
    categoriacargo_id,-- Relación con categoría de cargo
    teldirecto,       -- Teléfono directo
    interno,          -- Teléfono interno
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
    Ipersona AS id,                  -- Mapeo del ID
    Nombre AS nombre,                -- Nombre
    Apellido AS apellido,            -- Apellido
    Idproveedores AS proveedor_id,   -- Relación con proveedores
    Idarea AS area_id,               -- Relación con área
    Idcargo AS cargo_id,             -- Relación con cargo
    cate_cargo AS categoriacargo_id, -- Relación con categoría de cargo
    TelDirecto AS teldirecto,        -- Teléfono directo
    Interno AS interno,              -- Teléfono interno
    TelCelular AS telcelular,        -- Teléfono celular
    Idprofesion AS profesion_id,     -- Relación con profesión
    Telparticular AS telparticular,  -- Teléfono particular
    Mail AS email,                   -- Correo electrónico
    INFOparticular AS observaciones, -- Observaciones
    fuera,                           -- Indicador de fuera
    'A' AS status,                   -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at, -- Fecha actual como created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha actual como updated_at
FROM fraschin_backup.personalproveedores
WHERE Ipersona IS NOT NULL;          -- Asegurar que el ID no sea nulo
