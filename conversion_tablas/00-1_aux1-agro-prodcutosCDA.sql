SET foreign_key_checks = 0;

INSERT INTO
    fraschina_2024.agros (
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
    'A' AS status, -- Asignar un valor constante para el campo 'status' si es necesario
    CURRENT_TIMESTAMP AS created_at, -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.agro
WHERE
    Idagro IS NOT NULL;
-- Asegurarse de que 'Idagro' no sea nulo

INSERT INTO
    fraschina_2024.agro_personal (
        id,
        nombre,
        apellido,
        agro_id,
        area_id,
        cargo_id,
        categoriacargo_id,
        teldirecto,
        interno,
        telcelular,
        profesion_id,
        telparticular,
        email,
        observaciones,
        fuera,
        status,
        created_at,
        updated_at
    )
SELECT
    Ipersona AS id,
    Nombre AS nombre,
    Apellido AS apellido,
    Idagro AS agro_id,
    Idarea AS area_id,
    Idcargo AS cargo_id,
    cate_cargo AS categoriacargo_id,
    TelDirecto AS teldirecto,
    Interno AS interno,
    TelCelular AS telcelular,
    Idprofesion AS profesion_id,
    Telparticular AS telparticular,
    Mail AS email,
    INFOparticular AS observaciones,
    CASE
        WHEN fuera = '1' THEN 1
        ELSE 0
    END AS fuera, -- Convertir 'fuera' de varchar a tinyint
    'A' AS status, -- Asignar un valor constante para el campo 'status', por ejemplo, 'A' (activo)
    CURRENT_TIMESTAMP AS created_at, -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.personalagro
WHERE
    Ipersona IS NOT NULL;
-- Asegurarse de que 'Ipersona' no sea nulo

SET foreign_key_checks = 0;

INSERT INTO
    fraschina_2024.productos_c_d_a (
        id,
        productoCDA,
        ivancda,
        ivacda,
        stockmincda,
        stockmaxcda,
        stockcda,
        stockreservacda,
        stockdisponiblecda,
        stockfecentcda,
        cantultent,
        status,
        created_at,
        updated_at
    )
SELECT
    idPcdA AS id,
    ProductosCDA AS productoCDA,
    ivaNCDA AS ivancda,
    ivaCDA AS ivacda,
    stockMinCDA AS stockmincda,
    stockMaxCDA AS stockmaxcda,
    stockCDA AS stockcda,
    stockReserCDA AS stockreservacda,
    stockDispoCDA AS stockdisponiblecda,
    stkFecEntCDA AS stockfecentcda,
    cantUltEnt AS cantultent,
    'A' AS status,
    NOW() AS created_at,
    NOW() AS updated_at
FROM fraschin_backup.productoscda;