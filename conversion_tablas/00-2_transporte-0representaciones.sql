SET foreign_key_checks = 0;

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
        id, -- Respetamos el ID antiguo
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
    idcliente AS id, -- Tomamos el ID de la tabla vieja
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

SET foreign_key_checks = 1;