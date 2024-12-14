INSERT INTO fraschina_2024.molinos (
    id,  -- columna id de la tabla destino
    razonsocial,
    dire_calle,
    dire_nro,
    piso,
    dpto,
    dire_obs,
    codpost,
    localidad_id,
    telefono,
    municipio_id,
    fax,
    cuit,
    excenciones,
    iva_id,
    info,
    correo,
    marcas,
    zona,
    barrio_id,
    status,
    created_at,
    updated_at
)
SELECT
    Idmolino AS id,  -- Ajustar si el nombre de la columna en la tabla de origen es diferente
    razonsocial,
    dire_calle,
    dire_nro,
    piso,
    dpto,
    dire_obs,
    codpos AS codpost,  -- Si el nombre de la columna de origen es diferente, ajusta aquí
    Idlocalidad AS localidad_id,  -- Ajustar nombres si es necesario
    Telefono,
    IdMunicipio AS municipio_id,  -- Ajustar nombres si es necesario
    Fax AS fax,
    CUIT AS cuit,
    Excenciones AS excenciones,
    Idiva AS iva_id,  -- Ajustar nombres si es necesario
    Info AS info,
    correo,
    marcas,
    zona,
    Idbarrio AS barrio_id,  -- Ajustar nombres si es necesario
    'A' AS status,  -- Valor constante para el campo 'status'
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para 'created_at'
    CURRENT_TIMESTAMP AS updated_at  -- Fecha y hora actual para 'updated_at'
FROM fraschin_backup.molinos
WHERE Idmolino IS NOT NULL;
