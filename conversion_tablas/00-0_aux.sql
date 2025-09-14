SET foreign_key_checks = 0;

INSERT INTO
    fraschina_2024.auxacciones (
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
    'A' AS status, -- Asignar un valor constante para 'status', por ejemplo, 'A' (activo)
    CURRENT_TIMESTAMP AS created_at, -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxaccion
WHERE
    id_accion IS NOT NULL;
-- Asegurarse de que 'id_accion' no sea nulo

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

SET foreign_key_checks = 1;