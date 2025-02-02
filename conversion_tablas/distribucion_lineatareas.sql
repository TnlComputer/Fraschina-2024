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