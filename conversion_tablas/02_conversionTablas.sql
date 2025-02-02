SET foreign_key_checks = 0;

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
    Ipersona AS id,
    Nombre AS nombre,
    Apellido AS apellido,
    Idcliente AS distribucion_id,
    Idarea AS area_id,
    Idcargo AS cargo_id,
    NULL AS categoriacargo_id,
    TelDirecto AS teldirecto,
    LEFT(Interno, 4) AS interno, -- Truncar a 4 caracteres
    TelCelular AS telcelular,
    Idprofesion AS profesion_id,
    Telparticular AS telparticular,
    Mail AS email,
    INFOparticular AS observaciones,
    CASE
        WHEN fuera = '1' THEN 1
        ELSE 0
    END AS fuera,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.personalclientesdist
WHERE
    Ipersona IS NOT NULL;





INSERT INTO
    fraschina_2024.expedicion_clientes (
        id,
        nroClie_id,
        linea1,
        linea2,
        linea3,
        linea4,
        linea5,
        linea6,
        obs,
        comentarios,
        created_at,
        updated_at
    )
SELECT
    idExpClie AS id,
    nroClieExp AS nroClie_id,
    linea1Exp AS linea1,
    linea2Exp AS linea2,
    linea3Exp AS linea3,
    linea4Exp AS linea4,
    linea5Exp AS linea5,
    linea6Exp AS linea6,
    ObsExp AS obs,
    ComentExp AS comentarios,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.expedicionclie;

INSERT INTO
    fraschina_2024.expedicion_molinos_textos_clientes (
        id,
        expClie_id,
        expMolino_id,
        linea1,
        linea2,
        linea3,
        linea4,
        linea5,
        linea6,
        created_at,
        updated_at
    )
SELECT
    idExpMTC AS id,
    idExpClie AS expClie_id,
    idExpMoli AS expMolino_id,
    linea1Exp AS linea1,
    linea2Exp AS linea2,
    linea3Exp AS linea3,
    linea4Exp AS linea4,
    linea5Exp AS linea5,
    linea6Exp AS linea6,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.expedicionmtc;

INSERT INTO
    fraschina_2024.expedicion_molinos (
        id,
        nroMolino_id,
        calificacion,
        sigla,
        nroUPed,
        contMolino,
        estadoNroPedido,
        nroCliente_id,
        created_at,
        updated_at
    )
SELECT
    idExpMoli AS id,
    nroMolinoExp AS nroMolino_id,
    calificacionExp AS calificacion,
    SiglaExp AS sigla,
    nroUPedExp AS nroUPed,
    contMoliExp AS contMolino,
    estadoNroPed AS estadoNroPedido,
    nroClieEst AS nroCliente_id,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.expedicionmoli;

INSERT INTO
    fraschina_2024.molinos (
        id, -- columna id de la tabla destino
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
    Idmolino AS id, -- Ajustar si el nombre de la columna en la tabla de origen es diferente
    razonsocial,
    dire_calle,
    dire_nro,
    piso,
    dpto,
    dire_obs,
    codpos AS codpost, -- Si el nombre de la columna de origen es diferente, ajusta aquí
    Idlocalidad AS localidad_id, -- Ajustar nombres si es necesario
    Telefono,
    IdMunicipio AS municipio_id, -- Ajustar nombres si es necesario
    Fax AS fax,
    CUIT AS cuit,
    Excenciones AS excenciones,
    Idiva AS iva_id, -- Ajustar nombres si es necesario
    Info AS info,
    correo,
    marcas,
    zona,
    Idbarrio AS barrio_id, -- Ajustar nombres si es necesario
    'A' AS status, -- Valor constante para el campo 'status'
    CURRENT_TIMESTAMP AS created_at, -- Fecha y hora actual para 'created_at'
    CURRENT_TIMESTAMP AS updated_at -- Fecha y hora actual para 'updated_at'
FROM fraschin_backup.molinos
WHERE
    Idmolino IS NOT NULL;

INSERT INTO
    fraschina_2024.molino_personal (
        id,
        nombre,
        apellido,
        molino_id,
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
    Idmolino AS molino_id,
    Idarea AS area_id,
    Idcargo AS cargo_id,
    cate_cargo AS categoriacargo_id,
    TelDirecto AS teldirecto,
    LEFT(Interno, 4) AS interno, -- Limitar a 4 caracteres
    TelCelular AS telcelular,
    Idprofesion AS profesion_id,
    Telparticular AS telparticular,
    Mail AS email,
    INFOparticular AS observaciones,
    fuera,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.personalmolino
WHERE
    Ipersona IS NOT NULL;


INSERT INTO
    proveedor_aux_productos (
        id, -- ID del producto
        nombre, -- Nombre del producto
        is_active, -- Estado activo (por defecto TRUE)
        created_at, -- Fecha y hora de creación
        updated_at -- Fecha y hora de última actualización
    )
SELECT
    Id_Producto AS id, -- ID del producto en la tabla original
    Producto AS nombre, -- Nombre del producto en la tabla original
    TRUE AS is_active, -- Asignar TRUE como valor constante para 'is_active'
    CURRENT_TIMESTAMP AS created_at, -- Fecha y hora actual para 'created_at'
    CURRENT_TIMESTAMP AS updated_at -- Fecha y hora actual para 'updated_at'
FROM fraschin_backup.auxproductosproveedores
WHERE
    Id_Producto IS NOT NULL;
-- Asegurarse de que 'Id_Producto' no sea nulo

INSERT INTO
    fraschina_2024.proveedores (
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
    LEFT(Familia, 10) AS familia, -- Asegurar que la longitud no exceda 10 caracteres
    piso,
    dpto,
    'A' AS status, -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.proveedores
WHERE
    Idproveedores IS NOT NULL;
-- Asegurar que el ID no sea nulo

UPDATE fraschin_backup.personalproveedores
SET
    Idprofesion = 132
WHERE
    Idprofesion = 40;

INSERT INTO
    fraschina_2024.proveedor_personal (
        nombre, -- Nombre del personal
        apellido, -- Apellido del personal
        proveedor_id, -- Relación con proveedor
        area_id, -- Relación con área
        cargo_id, -- Relación con cargo
        categoriacargo_id, -- Relación con categoría de cargo
        teldirecto, -- Teléfono directo
        interno, -- Teléfono interno
        telcelular, -- Teléfono celular
        profesion_id, -- Relación con profesión
        telparticular, -- Teléfono particular
        email, -- Correo electrónico
        observaciones, -- Observaciones (información adicional)
        fuera, -- Indicador de fuera
        status, -- Estado del registro
        created_at, -- Fecha de creación
        updated_at -- Fecha de actualización
    )
SELECT
    Nombre AS nombre, -- Nombre
    Apellido AS apellido, -- Apellido
    Idproveedores AS proveedor_id, -- Relación con proveedores
    Idarea AS area_id, -- Relación con área
    Idcargo AS cargo_id, -- Relación con cargo
    cate_cargo AS categoriacargo_id, -- Relación con categoría de cargo
    TelDirecto AS teldirecto, -- Teléfono directo
    Interno AS interno, -- Teléfono interno
    TelCelular AS telcelular, -- Teléfono celular
    Idprofesion AS profesion_id, -- Relación con profesión
    Telparticular AS telparticular, -- Teléfono particular
    Mail AS email, -- Correo electrónico
    INFOparticular AS observaciones, -- Observaciones
    fuera, -- Indicador de fuera
    'A' AS status, -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at, -- Fecha actual como created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha actual como updated_at
FROM fraschin_backup.personalproveedores
WHERE
    Ipersona IS NOT NULL;

INSERT INTO
    fraschina_2024.proveedor_productos (
        id, -- ID principal
        proveedor_id, -- Relación con proveedores
        producto_id, -- Relación con productos
        status, -- Estado del registro
        created_at, -- Fecha de creación
        updated_at -- Fecha de actualización
    )
SELECT
    idProProveedor AS id, -- Mapeo de ID
    Idproveedores AS proveedor_id, -- Relación con proveedores
    Idproducto AS producto_id, -- Relación con productos
    'A' AS status, -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at, -- Fecha actual como created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha actual como updated_at
FROM fraschin_backup.productoporproveedor
WHERE
    idProProveedor IS NOT NULL;
-- Asegurar que el ID no sea nulo


INSERT INTO
    fraschina_2024.transportes (
        id, -- ID principal
        razonsocial, -- Razón social
        dire_calle, -- Calle
        dire_nro, -- Número
        piso, -- Piso
        dpto, -- Departamento
        dire_obs, -- Observaciones de la dirección
        codpost, -- Código postal
        localidad_id, -- Relación con localidad
        telefono, -- Teléfono
        fax, -- Fax
        cuit, -- CUIT
        excenciones, -- Exenciones
        barrio_id, -- Relación con barrio
        info, -- Información adicional
        correo, -- Correo electrónico
        municipio_id, -- Relación con municipio
        marcas, -- Marcas
        status, -- Estado del registro
        created_at, -- Fecha de creación
        updated_at -- Fecha de actualización
    )
SELECT
    Idtransporte AS id, -- ID principal
    RazonSocial AS razonsocial, -- Razón social
    dire_calle, -- Calle
    dire_nro, -- Número
    piso, -- Piso
    dpto, -- Departamento
    dire_obs, -- Observaciones de la dirección
    codpos AS codpost, -- Código postal
    Idlocalidad AS localidad_id, -- Relación con localidad
    Telefono AS telefono, -- Teléfono
    Fax AS fax, -- Fax
    CUIT AS cuit, -- CUIT
    Excenciones AS excenciones, -- Exenciones
    Idbarrio AS barrio_id, -- Relación con barrio
    Info AS info, -- Información adicional
    correo, -- Correo electrónico
    IdMunicipio AS municipio_id, -- Relación con municipio
    marcas, -- Marcas
    'A' AS status, -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at, -- Fecha actual como created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha actual como updated_at
FROM fraschin_backup.transportes
WHERE
    Idtransporte IS NOT NULL;
-- Asegurar que el ID no sea nulo

INSERT INTO
    fraschina_2024.transporte_personal (
        id, -- ID principal
        nombre, -- Nombre del personal
        apellido, -- Apellido del personal
        transporte_id, -- Relación con transporte
        area_id, -- Relación con área
        cargo_id, -- Relación con cargo
        categoriacargo_id, -- Relación con categoría de cargo
        teldirecto, -- Teléfono directo
        interno, -- Extensión interna
        telcelular, -- Teléfono celular
        profesion_id, -- Relación con profesión
        telparticular, -- Teléfono particular
        email, -- Correo electrónico
        observaciones, -- Observaciones (información adicional)
        fuera, -- Indicador de fuera
        status, -- Estado del registro
        created_at, -- Fecha de creación
        updated_at -- Fecha de actualización
    )
SELECT
    Ipersona AS id, -- ID principal
    Nombre AS nombre, -- Nombre
    Apellido AS apellido, -- Apellido
    Idtransporte AS transporte_id, -- Relación con transporte
    Idarea AS area_id, -- Relación con área
    Idcargo AS cargo_id, -- Relación con cargo
    cate_cargo AS categoriacargo_id, -- Relación con categoría de cargo
    TelDirecto AS teldirecto, -- Teléfono directo
    Interno AS interno, -- Extensión interna
    TelCelular AS telcelular, -- Teléfono celular
    Idprofesion AS profesion_id, -- Relación con profesión
    Telparticular AS telparticular, -- Teléfono particular
    Mail AS email, -- Correo electrónico
    INFOparticular AS observaciones, -- Observaciones
    IF(fuera = '1', 1, 0) AS fuera, -- Convertir fuera de varchar a tinyint
    'A' AS status, -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at, -- Fecha actual como created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha actual como updated_at
FROM fraschin_backup.personaltransportes
WHERE
    Ipersona IS NOT NULL;
-- Asegurar que el ID no sea nulo
-- Asegurar que el ID no sea nulo


SET foreign_key_checks = 1;