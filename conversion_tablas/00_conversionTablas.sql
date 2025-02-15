SET foreign_key_checks = 0;

INSERT INTO fraschina_2024.auxacciones (
    id,
    accion,
    colorAcc,
    colorCod,
    status,
    created_at,
    updated_at
)
SELECT
    id_accion AS id,
    accion,
    color_Acc AS colorAcc,
    cod_color AS colorCod,
    'A' AS status,  -- Asignar un valor constante para 'status', por ejemplo, 'A' (activo)
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxaccion
WHERE 
    id_accion IS NOT NULL;  -- Asegurarse de que 'id_accion' no sea nulo


INSERT INTO
    fraschina_2024.auxareas (
        id,
        area,
        created_at,
        updated_at
    )
SELECT
    Idarea AS id,
    Area AS area,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxareas;

INSERT INTO
    fraschina_2024.auxbarrios (
        id,
        nombrebarrio,
        created_at,
        updated_at
    )
SELECT
    Idbarrio AS id,
    NomBarrio AS nombrebarrio,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxbarrio;

INSERT INTO
    fraschina_2024.auxcalles (
        id,
        calle,
        created_at,
        updated_at
    )
SELECT
    id_Calle AS id,
    nombre_calle AS calle,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.calles;

INSERT INTO
    fraschina_2024.auxcargos (
        id,
        cargo,
        categoria_id,
        created_at,
        updated_at
    )
SELECT
    Idcargo AS id,
    Cargos AS cargo,
    CAST(cate AS UNSIGNED) AS categoria_id, -- Se asume que 'cate' es un número, y lo convertimos a tipo bigint
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxcargos;

INSERT INTO
    fraschina_2024.auxchoferes (
        id,
        chofer,
        nombre,
        apellido,
        color,
        created_at,
        updated_at
    )
SELECT
    idChofer AS id,
    chofer,
    nombre,
    apellido,
    color,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxchofer;

INSERT INTO
    fraschina_2024.auxcobrar (
        id,
        accion,
        created_at,
        updated_at
    )
SELECT
    idCobrar AS id,
    nomCobrar AS accion,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxcobrar;

INSERT INTO
    fraschina_2024.auxcontacto (
        id,
        contacto,
        created_at,
        updated_at
    )
SELECT
    Idcontacto AS id,
    Contacto AS contacto,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxcontacto;

INSERT INTO
    fraschina_2024.auxestados (
        id,
        nomEstado,
        created_at,
        updated_at
    )
SELECT
    id_estado AS id,
    estado AS nomEstado,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxestados;

INSERT INTO
    fraschina_2024.auxfamilias (
        id,
        familia,
        created_at,
        updated_at
    )
SELECT
    Idfamilia AS id,
    Familia AS familia,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxfamilia;

INSERT INTO
    fraschina_2024.auxhoras (
        id,
        hora,
        created_at,
        updated_at
    )
SELECT
    IdHora AS id,
    hora AS hora,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxhora;

INSERT INTO
    fraschina_2024.auxlocalidades (
        id,
        localidad,
        representaciones,
        distribuciones,
        molinos,
        proveedores,
        agros,
        transportes,
        agendas,
        created_at,
        updated_at
    )
SELECT
    Idlocalidad AS id,
    Localidad AS localidad,
    clirep AS representaciones,
    clidis AS distribuciones,
    molinos AS molinos,
    proveedores AS proveedores,
    agro AS agros,
    transporte AS transportes,
    Agenda AS agendas,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxlocalidades;

INSERT INTO
    fraschina_2024.auxmodos (
        id,
        nombre,
        created_at,
        updated_at
    )
SELECT
    Idmodo AS id,
    nomModo AS nombre,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxmodo;

INSERT INTO
    fraschina_2024.auxmunicipios (
        id,
        ciudadmunicipio,
        representaciones,
        distribuciones,
        molinos,
        proveedores,
        agros,
        transportes,
        agendas,
        created_at,
        updated_at
    )
SELECT
    Idmunicipio AS id,
    CiudadMunicipio AS ciudadmunicipio,
    clientes AS representaciones, -- Mapeo de la columna 'clientes' a 'representaciones'
    clientesDist AS distribuciones, -- Mapeo de la columna 'clientesDist' a 'distribuciones'
    molinos AS molinos,
    proveedores AS proveedores,
    agro AS agros,
    transporte AS transportes,
    transporte AS agendas, -- Mapeo de la columna 'transporte' a 'agendas'
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxmunicipio;

INSERT INTO
    fraschina_2024.auxorden (
        id,
        orden,
        created_at,
        updated_at
    )
SELECT
    idOrden AS id,
    orden AS orden,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxorden;

INSERT INTO
    fraschina_2024.auxpagos (
        id,
        nombre,
        created_at,
        updated_at
    )
SELECT
    idPagos AS id,
    nomPago AS nombre,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxpagos;

INSERT INTO
    fraschina_2024.auxprioridades (
        id,
        nombre,
        color,
        created_at,
        updated_at
    )
SELECT
    id_prio AS id,
    nom_pri AS nombre,
    color_Prio AS color,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxprior;

INSERT INTO
    fraschina_2024.auxprofesiones (
        id,
        nombreprofesion,
        representaciones,
        distribuciones,
        molinos,
        proveedores,
        agros,
        transportes,
        agendas,
        created_at,
        updated_at
    )
SELECT
    Idprofesion AS id,
    Profesion AS nombreprofesion,
    clirep AS representaciones,
    clidis AS distribuciones,
    molinos AS molinos,
    proveedores AS proveedores,
    agro AS agros,
    transporte AS transportes,
    Agenda AS agendas,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxprofesion;

INSERT INTO
    fraschina_2024.auxrubros (
        id,
        nombre,
        representaciones,
        distribuciones,
        molinos,
        proveedores,
        agros,
        transportes,
        agendas,
        created_at,
        updated_at
    )
SELECT
    Idrubro AS id,
    Rubro AS nombre,
    clirep AS representaciones,
    clidis AS distribuciones,
    molinos AS molinos,
    proveedores AS proveedores,
    agro AS agros,
    transporte AS transportes,
    Agenda AS agendas,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxrubro;

INSERT INTO
    fraschina_2024.auxtamanio (
        id,
        nombre,
        created_at,
        updated_at
    )
SELECT
    Idtamanio AS id,
    nomTama AS nombre,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxtamanio;

INSERT INTO
    fraschina_2024.auxtipopagos (
        id,
        nombre,
        created_at,
        updated_at
    )
SELECT
    idTPagos AS id,
    nomTPago AS nombre,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxtpagos;

INSERT INTO
    fraschina_2024.auxtipopersonal (
        id,
        tipo,
        created_at,
        updated_at
    )
SELECT
    id_tp AS id,
    tipo_tp AS tipo,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxtipopers;

INSERT INTO
    fraschina_2024.auxveraz (
        id,
        estado,
        color,
        created_at,
        updated_at
    )
SELECT
    id_veraz AS id,
    veraz AS estado,
    color_Veraz AS color,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxveraz;

INSERT INTO
    fraschina_2024.auxzonas (
        id,
        nombre,
        representaciones,
        distribuciones,
        molinos,
        proveedores,
        agros,
        transportes,
        agendas,
        created_at,
        updated_at
    )
SELECT
    IdZona AS id,
    NomZona AS nombre,
    agro AS representaciones,
    clirep AS distribuciones,
    clidis AS molinos,
    molinos AS proveedores,
    proveedores AS agros,
    transporte AS transportes,
    Agenda AS agendas,
    NOW() AS created_at, -- Fecha y hora actual para created_at
    NOW() AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxzonas;

INSERT INTO
    fraschina_2024.agendas (
        id,
        nombre,
        apellido,
        nomApe,
        empresa_institucion,
        profesion_especialidad_oficio,
        cod_prof,
        tel_particular,
        tel_laboral,
        interno,
        celular,
        mail,
        direccion,
        observaciones,
        buscador1,
        buscador2,
        buscador3,
        status,
        created_at,
        updated_at
    )
SELECT
    IDagenda AS id,
    Nombre AS nombre,
    Apellido AS apellido,
    nomApe AS nomApe,
    Empresa_Institucion AS empresa_institucion,
    Profesion_Especialidad_Oficio AS profesion_especialidad_oficio,
    cod_prof AS cod_prof,
    Tel_Particular AS tel_particular,
    Tel_Laboral AS tel_laboral,
    Interno AS interno,
    Celular AS celular,
    Mail AS mail,
    Direccion AS direccion,
    Observaciones AS observaciones,
    buscador1 AS buscador1,
    buscador2 AS buscador2,
    buscador3 AS buscador3,
    1 AS status, -- Asignar un valor constante para 'status', por ejemplo, 1 (activo)
    CURRENT_TIMESTAMP AS created_at, -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.agendageneral
WHERE
    IDagenda IS NOT NULL;
-- Asegurarse de que 'IDagenda' no sea nulo



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
        fechagira,
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
    Idcliente AS id,
    IdcliSG AS clisg_id,
    `Idcli-CDanterior` AS cliCDant_id, -- Usamos comillas invertidas aquí
    RazonSocial AS razonsocial,
    NomFantasia AS nomfantasia,
    dire_calle AS dire_calle_id,
    dire_nro AS dire_nro,
    dire_obs AS dire_obs,
    codpos AS codpost,
    Idbarrio AS barrio_id,
    Zona AS zona_id,
    Telefono AS telefono,
    Fax AS fax,
    CUIT AS cuit,
    fac_imp AS fac_imp,
    IdMunicipio AS municipio_id,
    INFOenParticular AS marcas,
    Info AS info,
    Contacto AS contacto_id,
    Horario AS horario,
    Objetivos AS objetivos,
    Comentarios AS comentarios,
    FechaGira AS fechagira,
    rubro AS rubro_id,
    tamanio AS tamanio_id,
    modo AS modo_id,
    IdLocalidad AS localidad_id,
    correo AS correo,
    piso AS piso,
    dpto AS dpto,
    desde AS desde,
    hasta AS hasta,
    lunes AS lunes,
    sabado AS sabado,
    productos AS productos_id,
    Idveraz AS veraz_id,
    Idestado AS estado_id,
    obsRecep AS obsrecep,
    desde1 AS desde1,
    hasta1 AS hasta1,
    auto AS auto,
    productCDA AS productoCDA,
    cobro AS cobro_id,
    tcobro AS tcobro_id,
    cobrar AS cobrar_id,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.clientesdistribucion
WHERE
    Idcliente IS NOT NULL;

INSERT INTO
    distribucion_aux_productos (
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
FROM fraschin_backup.auxproductosdist
WHERE
    Id_Producto IS NOT NULL;
-- Asegurarse de que 'Id_Producto' no sea nulo

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
    IdProCli AS id,
    Idcliente AS distribucion_id,
    Idproducto AS producto_id,
    CASE
        WHEN precio REGEXP '^[0-9]+(\.[0-9]+)?$' THEN CAST(precio AS FLOAT)
        ELSE NULL
    END AS precio, -- Convertir solo valores válidos
    fechaprecio AS fecha,
    nomProd AS nomproducto,
    fechaUEnt,
    'A' AS status, -- Asignar estado activo por defecto
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.productoporclientedist
WHERE
    IdProCli IS NOT NULL;
-- Evitar registros nulos en la clave primaria

INSERT INTO
    fraschina_2024.distribucion_tareas (
        id,
        tarea,
        status,
        created_at,
        updated_at
    )
SELECT
    idTcdA AS id, -- Mapeo de idTcdA al campo id
    tareasCDA AS tarea, -- Mapeo de tareasCDA al campo tarea
    'A' AS status, -- Asignar 'A' como estado por defecto
    CURRENT_TIMESTAMP AS created_at, -- Fecha actual para created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha actual para updated_at
FROM fraschin_backup.tareascda
WHERE
    idTcdA IS NOT NULL;
-- Asegurarse de que la clave primaria no sea nula

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
    fraschina_2024.distribucion_nropedidos (
        id,
        tipo,
        distribucion_id,
        fecha,
        fechaEntrega,
        observaciones,
        status,
        created_at,
        updated_at
    )
SELECT
    np.id_NroPed AS id,
    'D' AS tipo,
    np.cliente AS distribucion_id,
    -- Convertir fechaPed a NULL si es inválida
    IFNULL(np.fechaPed, NULL) AS fecha,
    -- Convertir fechaEnt a NULL si es inválida
    IFNULL(np.fechaEnt, NULL) AS fechaEntrega,
    np.obsPed AS observaciones,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.nropedidos np
WHERE
    np.cliente IN (
        SELECT id
        FROM fraschina_2024.distribucions
    )
    AND (
        -- Aseguramos que al menos una de las fechas sea válida
        np.fechaPed IS NOT NULL
        OR np.fechaEnt IS NOT NULL
    )
ON DUPLICATE KEY UPDATE
    tipo = VALUES(tipo),
    distribucion_id = VALUES(distribucion_id),
    fecha = VALUES(fecha),
    fechaEntrega = VALUES(fechaEntrega),
    observaciones = VALUES(observaciones),
    status = VALUES(status),
    created_at = VALUES(created_at),
    updated_at = VALUES(updated_at);

INSERT INTO
    fraschina_2024.distribucion_linea_pedidos (
        pedido_id,
        distribucion_id,
        fecha,
        fechaEntrega,
        linea,
        producto_id,
        cantidad,
        precio_unitario,
        totalLinea,
        cambiar,
        retirar,
        estado_pedido,
        status,
        created_at,
        updated_at
    )
SELECT
    CAST(lp.nroPed AS UNSIGNED), -- Convertir nroPed a número
    lp.idCliente, -- ID del cliente como distribucion_id
    lp.fechaPed,
    lp.fecEntrega,
    lp.linea,
    lp.producto_id,
    CAST(
        NULLIF(TRIM(lp.cantidad), '') AS UNSIGNED
    ), -- Evitar valores vacíos en cantidad
    CASE
        WHEN lp.preunit IS NOT NULL
        AND lp.preunit != '' THEN CAST(
            REPLACE (lp.preunit, ',', '.') AS DECIMAL(12, 2)
        ) -- Reemplazar coma por punto y convertir
        ELSE 0
    END, -- Convertir solo si tiene un valor válido, de lo contrario poner 0
    lp.totalPedidoN, -- Total de la línea del pedido
    lp.cambiar,
    lp.retirar,
    CAST(lp.estado_Ped AS CHAR(1)), -- Convertir estado a string
    1, -- Definir un estado por defecto (1 para activo)
    NOW(),
    NOW()
FROM fraschin_backup.lineapedidos AS lp
WHERE
    CAST(lp.nroPed AS UNSIGNED) IN (
        SELECT id
        FROM fraschina_2024.distribucion_nropedidos
    );

INSERT INTO
    fraschina_2024.distribucion_linea_tareas (
        pedido_id,
        distribucion_id,
        fecha,
        fechaEntrega,
        linea,
        tarea_id,
        detalles,
        estado_pedido,
        status,
        created_at,
        updated_at
    )
SELECT CAST(lt.nroPed AS UNSIGNED), -- Convertir nroPed a número
    lt.idCliente, -- ID del cliente como distribucion_id
    lt.fechaPed, lt.fecEntrega, lt.linea, lt.tarea_id, lt.detalles, CAST(
        lt.estado_Ped AS DECIMAL(1, 0)
    ), -- Convertir estado
    'A', -- Siempre asignamos 'A' como status
    NOW(), NOW()
FROM fraschin_backup.lineatareas AS lt
WHERE
    CAST(lt.nroPed AS UNSIGNED) IN (
        SELECT id
        FROM fraschina_2024.distribucion_nropedidos
    );

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
--

INSERT INTO
    representacion_aux_productos (
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
FROM fraschin_backup.auxproductos
WHERE
    Id_Producto IS NOT NULL;
-- Asegurarse de que 'Id_Producto' no sea nulo

UPDATE fraschin_backup.personalclientes
SET
    `Idprofesion` = 132
WHERE
    `Idprofesion` = 40;

INSERT INTO
    fraschina_2024.representacion_personal (
        `nombre`,
        `apellido`,
        `representacion_id`,
        `area_id`,
        `cargo_id`,
        `categoriacargo_id`,
        `teldirecto`,
        `interno`,
        `telcelular`,
        `profesion_id`,
        `telparticular`,
        `email`,
        `observaciones`,
        `fuera`,
        `status`,
        `created_at`,
        `updated_at`
    )
SELECT
    `Nombre`,
    `Apellido`,
    IF(
        `Idcliente` = 0,
        NULL,
        `Idcliente`
    ) AS `representacion_id`, -- Asigna NULL si es 0
    `Idarea` AS `area_id`,
    `Idcargo` AS `cargo_id`,
    `cate_cargo` AS `categoriacargo_id`,
    `TelDirecto` AS `teldirecto`,
    `Interno` AS `interno`,
    `TelCelular` AS `telcelular`,
    `Idprofesion` AS `profesion_id`,
    `Telparticular` AS `telparticular`,
    `Mail` AS `email`,
    `INFOparticular` AS `observaciones`,
    `fuera`,
    'A' AS `status`,
    CURRENT_TIMESTAMP AS `created_at`,
    CURRENT_TIMESTAMP AS `updated_at`
FROM fraschin_backup.personalclientes
WHERE
    Ipersona IS NOT NULL;

INSERT INTO
    fraschina_2024.representacion_productos (
        `representacion_id`,
        `producto_id`,
        `pl`,
        `P`,
        `l`,
        `w`,
        `glutenhumedo`,
        `glutenseco`,
        `cenizas`,
        `fn`,
        `humedad`,
        `estabilidad`,
        `absorcion`,
        `puntuaciones`,
        `particularidades`,
        `status`,
        `created_at`,
        `updated_at`
    )
SELECT
    IF(
        pc.Idcliente = 0,
        NULL,
        pc.Idcliente
    ) AS `representacion_id`, -- Asigna NULL si es 0
    pc.Idproducto AS `producto_id`, -- Copia el Idproducto como producto_id
    pc.PL AS `pl`,
    pc.P AS `P`,
    pc.L AS `l`,
    pc.W AS `w`,
    pc.GlutenHumedo AS `glutenhumedo`,
    pc.GlutenSeco AS `glutenseco`,
    pc.Cenizas AS `cenizas`,
    pc.FN AS `fn`,
    pc.Humedad AS `humedad`,
    pc.Estabilidad AS `estabilidad`,
    pc.Absorcion AS `absorcion`,
    pc.Puntuaciones AS `puntuaciones`,
    pc.PARTICULARIDADES AS `particularidades`,
    'A' AS `status`, -- Establece el valor por defecto 'A' para status
    CURRENT_TIMESTAMP AS `created_at`, -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS `updated_at` -- Fecha y hora actual para updated_at
FROM fraschin_backup.productoporcliente pc
WHERE
    pc.IdProCli IS NOT NULL;
-- Asegura que solo se copien los registros válidos

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

INSERT INTO
    fraschina_2024.representacions (
        razonsocial,
        dire_calle,
        dire_nro,
        piso,
        codpost,
        dire_obs,
        telefono,
        fax,
        cuit,
        excenciones,
        iva_id,
        marcas,
        info,
        contacto,
        horario,
        objetivos,
        comentarios,
        fechagira,
        correo,
        dpto,
        barrio_id,
        localidad_id,
        zona_id,
        municipio_id
    )
SELECT
    RazonSocial,
    dire_calle,
    dire_nro,
    piso,
    codpos,
    dire_obs,
    Telefono,
    Fax,
    CUIT,
    Excenciones,
    Idiva,
    NULL AS marcas, -- Asumiendo que esta columna no está en clientes
    Info,
    Contacto,
    Horario,
    Objetivos,
    Comentarios,
    FechaGira,
    correo,
    dpto,
    Idbarrio AS barrio_id,
    Idlocalidad AS localidad_id,
    Zona AS zona_id,
    IdMunicipio AS municipio_id
FROM fraschin_backup.clientes;

INSERT IGNORE INTO
    fraschina_2024.distribucion_agenda (
        id,
        fecha,
        hs,
        prioridad_id,
        accion_id,
        temas,
        cotizacion,
        fecCotEnt,
        fecCot,
        producto_id,
        distribucion_id,
        persona_id,
        tipoper_id,
        veraz_id,
        estado_id,
        contacto_id,
        cargo_id,
        barrio_id,
        municipio_id,
        localidad_id,
        zona_id,
        rubro_id,
        tamanio_id,
        modo_id,
        pedido_id,
        estadoPedido,
        status,
        created_at,
        updated_at
    )
SELECT
    id_CDAg AS id,
    fecha_CDAg AS fecha,
    hora_CDAg AS hs,
    idPrio AS prioridad_id,
    idAccion AS accion_id,
    temas_CDAg AS temas,
    cotiz_CDAg AS cotizacion,
    fecCotEnt_CDAg AS fecCotEnt,
    fecCot_CDAg AS fecCot,
    idProductoCDA AS producto_id,
    Idcliente AS distribucion_id,
    id_persCD AS persona_id,
    id_tipoper AS tipoper_id,
    idVeraz AS veraz_id,
    idEstado AS estado_id,
    idContInit AS contacto_id,
    idCargo AS cargo_id,
    idBarrio AS barrio_id,
    idCiudad AS municipio_id,
    idLocalidad AS localidad_id,
    idZona AS zona_id,
    idRubro AS rubro_id,
    idTamano AS tamanio_id,
    idModo AS modo_id,
    pedidosID AS pedido_id,
    estadoPed AS estadoPedido,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.CDagenda;

UPDATE fraschina_2024.distribucion_nropedidos AS dn
LEFT JOIN fraschin_backup.lineapedidos AS lp ON dn.id = lp.nroPed
SET
    dn.tipo = CASE
        WHEN lp.nroPed IS NOT NULL THEN 'P'
        ELSE 'D'
    END,
    dn.fechaFactura = lp.fecFac_Ped,
    dn.nroFactura = lp.nroFac_Ped,
    dn.totalFactura = lp.impFac_Ped,
    dn.totalPedido = CASE
        WHEN lp.totalPedidoN IS NOT NULL
        AND lp.totalPedidoN REGEXP '^[0-9]+(\.[0-9]+)?$' THEN CAST(
            lp.totalPedidoN AS DECIMAL(10, 2)
        )
        ELSE NULL
    END,
    dn.chofer = lp.chofer_Ped,
    dn.orden = lp.orden_Ped
WHERE
    lp.linea = '1';
    
    UPDATE fraschina_2024.distribucion_nropedidos d
JOIN fraschin_backup.lineapedidos l ON d.id = l.nroPed
SET
    d.fechaFactura = l.fecFac_Ped,
    d.nroFactura = l.nroFac_Ped,
    d.totalFactura = l.impFac_Ped,
    d.totalPedido = l.totalPedidoN,
    d.chofer = l.chofer_Ped,
    d.orden = l.orden_Ped,
    -- d.observaciones = l.nom_prod,
    d.status = 'A',
    d.tipo = 'P'
WHERE
    l.linea = '1'
    AND l.totalPedido IS NOT NULL
    AND l.fecFac_Ped IS NOT NULL;
-- AND l.fecFac_Ped <> '0000-00-00';

UPDATE fraschina_2024.distribucion_nropedidos d
JOIN fraschin_backup.lineatareas l ON d.id = l.nroPed
SET
    d.tipo = CASE
        WHEN l.nroPed IS NOT NULL
        AND d.nroFactura IS NOT NULL THEN 'PT'
        ELSE 'T'
    END
WHERE
    l.nroPed IS NOT NULL;
    
    SET foreign_key_checks = 1;
