INSERT INTO fraschina_2024.agros (
    id,
    razonsocial,
    dire_calle,
    dire_nro,
    codpost,
    dire_obs,
    localidad_id,
    telefono,
    fax,
    cuit,
    marcas,
    rubro_id,
    info,
    correo,
    municipio_id,
    piso,
    dpto,
    barrio_id,
    status,
    created_at,
    updated_at
)
SELECT
    Idagro AS id,
    RazonSocial AS razonsocial,
    dire_calle,
    dire_nro,
    codpos AS codpost,
    dire_obs,
    Idlocalidad AS localidad_id,
    Telefono AS telefono,
    Fax AS fax,
    CUIT AS cuit,
    marcas,
    Idrubro AS rubro_id,
    Info AS info,
    correo,
    IdMunicipio AS municipio_id,
    piso,
    dpto,
    Idbarrio AS barrio_id,
    'A' AS status,  -- Asignar un valor constante para el campo 'status' si es necesario
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha y hora actual para updated_at
FROM fraschin_backup.agro
WHERE
    Idagro IS NOT NULL;  -- Asegurarse de que 'Idagro' no sea nulo
