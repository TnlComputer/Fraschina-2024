SET @OLD_SQL_MODE = @@sql_mode;

SET
    SESSION sql_mode =
REPLACE (
        @@sql_mode,
        'STRICT_TRANS_TABLES',
        ''
    );

SET SESSION sql_mode = REPLACE ( @@sql_mode, 'NO_ZERO_DATE', '' );

SET foreign_key_checks = 0;

-- Nro Pedidos
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
SELECT np.id_NroPed, 'D', np.cliente, NULLIF(np.fechaPed, '0000-00-00'), NULLIF(np.fechaEnt, '0000-00-00'), np.obsPed, 'A', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
FROM fraschin_backup.nropedidos np
WHERE
    np.cliente IN (
        SELECT id
        FROM fraschina_2024.distribucions
    )
    AND (
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

-- Linea Pedidos
INSERT INTO
    fraschina_2024.distribucion_linea_pedidos (
        id,
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
    id_linea,
    CAST(lp.nroPed AS UNSIGNED),
    lp.idCliente,
    NULLIF(lp.fechaPed, '0000-00-00'),
    NULLIF(lp.fecEntrega, '0000-00-00'),
    lp.linea,
    lp.producto_id,
    CAST(
        NULLIF(TRIM(lp.cantidad), '') AS UNSIGNED
    ),
    CASE
        WHEN lp.preunit IS NOT NULL
        AND lp.preunit != '' THEN CAST(
            REPLACE (lp.preunit, ',', '.') AS DECIMAL(12, 2)
        )
        ELSE 0
    END,
    lp.totalPedidoN,
    lp.cambiar,
    lp.retirar,
    CAST(lp.estado_Ped AS CHAR(1)),
    1,
    NOW(),
    NOW()
FROM fraschin_backup.lineapedidos lp
WHERE
    CAST(lp.nroPed AS UNSIGNED) IN (
        SELECT id
        FROM fraschina_2024.distribucion_nropedidos
    );

-- Linea Tareas
INSERT INTO
    fraschina_2024.distribucion_linea_tareas (
        id,
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
SELECT id_linea, CAST(lt.nroPed AS UNSIGNED), lt.idCliente, NULLIF(lt.fechaPed, '0000-00-00'), NULLIF(lt.fecEntrega, '0000-00-00'), lt.linea, lt.tarea_id, lt.detalles, CAST(
        lt.estado_Ped AS DECIMAL(1, 0)
    ), 'A', NOW(), NOW()
FROM fraschin_backup.lineatareas lt
WHERE
    CAST(lt.nroPed AS UNSIGNED) IN (
        SELECT id
        FROM fraschina_2024.distribucion_nropedidos
    );

SET foreign_key_checks = 1;

SET SESSION sql_mode = @OLD_SQL_MODE;