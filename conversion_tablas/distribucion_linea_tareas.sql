INSERT INTO
    fraschina_2024.distribucion_linea_tareas (
        fecha,
        tarea_id,
        cantidad,
        linea,
        bandera,
        distribucion_id,
        fechaEntrega,
        prePed,
        estado_pedido,
        detalles,
        pedido_id,
        status,
        created_at,
        updated_at
    )
SELECT
    lt.fechaPed AS fecha,
    lt.tarea_id AS tarea_id,
    CASE
        WHEN NULLIF(lt.cantidad, '') IS NULL THEN 0
        ELSE CAST(lt.cantidad AS DECIMAL(8, 2))
    END AS cantidad,
    lt.linea,
    lt.bandera,
    lt.idCliente AS distribucion_id,
    lt.fecEntrega AS fechaEntrega,
    lt.prePed,
    CAST(
        lt.estado_Ped AS DECIMAL(10, 2)
    ) AS estado_pedido,
    lt.detalles,
    lt.nroPed AS pedido_id, -- Relación con el número de pedido
    'A' AS status, -- Valor constante 'A' para el estado
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.lineatareas AS lt
WHERE
    lt.id_linea IS NOT NULL
    AND EXISTS (
        SELECT 1
        FROM fraschina_2024.distribucion_nropedidos AS np
        WHERE
            np.distribucion_id = lt.idCliente
            AND np.fechaEntrega = lt.fecEntrega
    );