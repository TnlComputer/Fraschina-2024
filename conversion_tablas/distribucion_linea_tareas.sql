INSERT INTO fraschina_2024.distribucion_linea_tareas (
    id,
    fecha,
    tadea_id,
    cantidad,
    linea,
    bandera,
    distribucion_id,
    fechaEntrega,
    prePed,
    estado_pedido,
    distribucion_tarea_id,
    detalles,
    pedido_id,
    status,
    created_at,
    updated_at
)
SELECT
    id_linea AS id,
    fechaPed AS fecha,
    tarea_id AS tadea_id,
    CASE 
        WHEN NULLIF(cantidad, '') IS NULL THEN 0 -- Si cantidad está vacía, asignar 0
        ELSE CAST(cantidad AS DECIMAL(8,2))     -- Convertir cantidad a decimal
    END AS cantidad,
    linea,
    bandera,
    idCliente AS distribucion_id,
    fecEntrega AS fechaEntrega,
    prePed,
    CAST(estado_Ped AS DECIMAL(10,2)) AS estado_pedido, -- Convertir estado_Ped a decimal
    NULL AS distribucion_tarea_id,  -- Si no hay equivalencia directa
    detalles,
    NULL AS pedido_id,  -- Si no hay equivalencia directa
    'A' AS status,  -- Asignar un valor constante para el campo status
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.lineatareas
WHERE 
    id_linea IS NOT NULL;  -- Evitar registros nulos en id_linea
