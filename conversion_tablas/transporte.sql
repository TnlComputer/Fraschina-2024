INSERT INTO fraschina_2024.transportes (
    id,             -- ID principal
    razonsocial,    -- Razón social
    dire_calle,     -- Calle
    dire_nro,       -- Número
    piso,           -- Piso
    dpto,           -- Departamento
    dire_obs,       -- Observaciones de la dirección
    codpost,        -- Código postal
    localidad_id,   -- Relación con localidad
    telefono,       -- Teléfono
    fax,            -- Fax
    cuit,           -- CUIT
    excenciones,    -- Exenciones
    barrio_id,      -- Relación con barrio
    info,           -- Información adicional
    correo,         -- Correo electrónico
    municipio_id,   -- Relación con municipio
    marcas,         -- Marcas
    status,         -- Estado del registro
    created_at,     -- Fecha de creación
    updated_at      -- Fecha de actualización
)
SELECT
    Idtransporte AS id,         -- ID principal
    RazonSocial AS razonsocial, -- Razón social
    dire_calle,                 -- Calle
    dire_nro,                   -- Número
    piso,                       -- Piso
    dpto,                       -- Departamento
    dire_obs,                   -- Observaciones de la dirección
    codpos AS codpost,          -- Código postal
    Idlocalidad AS localidad_id,-- Relación con localidad
    Telefono AS telefono,       -- Teléfono
    Fax AS fax,                 -- Fax
    CUIT AS cuit,               -- CUIT
    Excenciones AS excenciones, -- Exenciones
    Idbarrio AS barrio_id,      -- Relación con barrio
    Info AS info,               -- Información adicional
    correo,                     -- Correo electrónico
    IdMunicipio AS municipio_id,-- Relación con municipio
    marcas,                     -- Marcas
    'A' AS status,              -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at, -- Fecha actual como created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha actual como updated_at
FROM fraschin_backup.transportes
WHERE Idtransporte IS NOT NULL; -- Asegurar que el ID no sea nulo
