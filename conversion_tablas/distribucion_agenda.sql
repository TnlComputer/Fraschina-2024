INSERT INTO
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
    CASE
        WHEN idProductoCDA IN (
            SELECT id
            FROM fraschina_2024.productos_c_d_a
        ) THEN idProductoCDA
        ELSE NULL
    END AS producto_id,
    Idcliente AS distribucion_id,
    NULLIF(id_persCD, '') AS persona_id,
    id_tipoper AS tipoper_id,
    idVeraz AS veraz_id,
    idEstado AS estado_id,
    idContInit AS contacto_id,
    NULLIF(idCargo, '') AS cargo_id,
    idBarrio AS barrio_id,
    idCiudad AS municipio_id,
    idLocalidad AS localidad_id,
    idZona AS zona_id,
    idRubro AS rubro_id,
    idTamano AS tamanio_id,
    idModo AS modo_id,
    CASE
        WHEN pedidosID IN (
            SELECT id
            FROM fraschina_2024.distribucion_nropedidos
        ) THEN pedidosID
        ELSE NULL
    END AS pedido_id,
    estadoPed AS estadoPedido,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.CDagenda
WHERE
    id_CDAg IS NOT NULL
    AND Idcliente IN (
        SELECT id
        FROM fraschina_2024.distribucions
    )
    AND NULLIF(id_persCD, '') IN (
        SELECT id
        FROM fraschina_2024.distribucion_personal
    )
    AND NULLIF(idContInit, '') IN (
        SELECT id
        FROM fraschina_2024.auxcontacto
    );