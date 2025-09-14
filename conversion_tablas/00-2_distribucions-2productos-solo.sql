-- Desactivar temporalmente las comprobaciones de claves foráneas
SET foreign_key_checks = 0;

-- Distribucion Productos Aux
INSERT INTO
    distribucion_aux_productos (
        id,
        nombre,
        is_active,
        created_at,
        updated_at
    )
SELECT Id_Producto, Producto, TRUE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM fraschin_backup.auxproductosdist
WHERE
    Id_Producto IS NOT NULL;

-- Distribucion Productos
INSERT INTO
    fraschina_2024.distribucion_productos (
        id,
        distribucion_id,
        producto_id,
        precio,
        fecha,
        nomproducto,
        fechaUEnt,
        status,
        created_at,
        updated_at
    )
SELECT
    IdProCli,
    Idcliente,
    Idproducto,
    CASE
        WHEN precio REGEXP '^[0-9]+(\.[0-9]+)?$' THEN CAST(precio AS FLOAT)
        ELSE NULL
    END AS precio,
    fechaprecio AS fecha,
    nomProd,
    fechaUEnt AS fechaUEnt,
    'A' AS status,
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
FROM fraschin_backup.productoporclientedist
WHERE
    IdProCli IS NOT NULL;

-- Distribucions
INSERT INTO
    fraschina_2024.distribucions (
        id,
        clisg_id,
        cliCDant_id,
        razonsocial,
        nomfantasia,
        dire_calle_id,
        dire_nro,
        dire_obs,
        codpost,
        barrio_id,
        zona_id,
        telefono,
        fax,
        cuit,
        fac_imp,
        municipio_id,
        marcas,
        info,
        contacto_id,
        horario,
        objetivos,
        comentarios,
        rubro_id,
        tamanio_id,
        modo_id,
        localidad_id,
        correo,
        piso,
        dpto,
        desde,
        hasta,
        lunes,
        sabado,
        productos_id,
        veraz_id,
        estado_id,
        obsrecep,
        desde1,
        hasta1,
        auto,
        productoCDA,
        cobro_id,
        tcobro_id,
        cobrar_id,
        status,
        created_at,
        updated_at
    )
SELECT
    Idcliente,
    IdcliSG,
    `Idcli-CDanterior`,
    RazonSocial,
    NomFantasia,
    dire_calle,
    dire_nro,
    dire_obs,
    codpos,
    Idbarrio,
    Zona,
    Telefono,
    Fax,
    CUIT,
    fac_imp,
    IdMunicipio,
    INFOenParticular,
    Info,
    Contacto,
    Horario,
    Objetivos,
    Comentarios,
    rubro,
    tamanio,
    modo,
    IdLocalidad,
    correo,
    piso,
    dpto,
    NULLIF(desde, '') AS desde,
    NULLIF(hasta, '') AS hasta,
    lunes,
    sabado,
    productos,
    Idveraz,
    Idestado,
    obsRecep,
    NULLIF(desde1, '') AS desde1,
    NULLIF(hasta1, '') AS hasta1,
    auto,
    productCDA,
    cobro,
    tcobro,
    cobrar,
    'A',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
FROM fraschin_backup.clientesdistribucion
WHERE
    Idcliente IS NOT NULL;

-- Distribucion Tareas
INSERT INTO
    fraschina_2024.distribucion_tareas (
        id,
        tarea,
        status,
        created_at,
        updated_at
    )
SELECT idTcdA, tareasCDA, 'A', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM fraschin_backup.tareascda
WHERE
    idTcdA IS NOT NULL;

-- Distribucion Personal
INSERT INTO
    fraschina_2024.distribucion_personal (
        id,
        nombre,
        apellido,
        distribucion_id,
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
    Ipersona,
    Nombre,
    Apellido,
    Idcliente,
    Idarea,
    Idcargo,
    NULL,
    TelDirecto,
    LEFT(Interno, 4),
    TelCelular,
    Idprofesion,
    Telparticular,
    Mail,
    INFOparticular,
    CASE
        WHEN fuera = '1' THEN 1
        ELSE 0
    END,
    'A',
    CURRENT_TIMESTAMP,
    CURRENT_TIMESTAMP
FROM fraschin_backup.personalclientesdist
WHERE
    Ipersona IS NOT NULL;