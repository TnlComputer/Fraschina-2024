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
    pc.Idproducto AS `producto_id`,
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
    'A' AS `status`,
    CURRENT_TIMESTAMP AS `created_at`,
    CURRENT_TIMESTAMP AS `updated_at`
FROM fraschin_backup.productoporcliente pc
    JOIN fraschina_2024.representacions r ON pc.Idcliente = r.id -- Solo selecciona registros cuyo Idcliente exista en representacions
WHERE
    pc.IdProCli IS NOT NULL;

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
FROM fraschin_backup.personalclientes pc
    JOIN fraschina_2024.representacions r ON pc.Idcliente = r.id -- Asegura que solo se inserten registros con Idcliente válido en representacions
WHERE
    Ipersona IS NOT NULL;
    