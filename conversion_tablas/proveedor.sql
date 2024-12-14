INSERT INTO fraschina_2024.proveedores (
    id,
    razonsocial,
    dire_calle,
    dire_nro,
    dire_obs,
    codpost,
    localidad_id,
    telefono,
    fax,
    cuit,
    marcas,
    barrio_id,
    info,
    correo,
    municipio_id,
    rubro_id,
    familia,
    piso,
    dpto,
    status,
    created_at,
    updated_at
)
SELECT
    Idproveedores AS id,
    RazonSocial AS razonsocial,
    dire_calle,
    dire_nro,
    dire_obs,
    codpos AS codpost,
    Idlocalidad AS localidad_id,
    Telefono AS telefono,
    Fax AS fax,
    CUIT AS cuit,
    marcas,
    Idbarrio AS barrio_id,
    Info AS info,
    correo,
    IdMunicipio AS municipio_id,
    Idrubro AS rubro_id,
    LEFT(Familia, 10) AS familia,  -- Asegurar que la longitud no exceda 10 caracteres
    piso,
    dpto,
    'A' AS status, -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.proveedores
WHERE Idproveedores IS NOT NULL; -- Asegurar que el ID no sea nulo
