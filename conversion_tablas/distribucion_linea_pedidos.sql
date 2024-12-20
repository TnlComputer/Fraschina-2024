INSERT INTO fraschina_2024.distribucion_linea_pedidos (
    id,
    pedido_id,
    fecha,
    producto_id,
    cantidad,
    precio_unitario,
    totalPedido,
    totalPedidoN,
    total_factura,
    nombre_producto,
    linea,
    bandera,
    distribucion_id,
    fechaEntrega,
    prePed,
    cambiar,
    retirar,
    estado_pedido,
    estado_tarea,
    chofer,
    orden,
    fechaFactura,
    nroFactura,
    estado_stock,
    status,
    created_at,
    updated_at
)
SELECT
    id_linea AS id,
    nroPed AS pedido_id,
    STR_TO_DATE(fechaPed, '%Y-%m-%d') AS fecha,
    CAST(producto_id AS UNSIGNED) AS producto_id,  -- Convertir a tipo int si es necesario
    CAST(COALESCE(NULLIF(cantidad, ''), '0') AS UNSIGNED) AS cantidad,  -- Convertir a int
    CAST(COALESCE(NULLIF(REPLACE(preunit, ',', '.'), ''), '0') AS DECIMAL(12, 2)) AS precio_unitario,
    CAST(COALESCE(NULLIF(REPLACE(totalPedido, ',', '.'), ''), '0.00') AS DECIMAL(12, 2)) AS totalPedido,
    CAST(COALESCE(NULLIF(REPLACE(totalPedidoN, ',', '.'), ''), '0.00') AS DECIMAL(12, 2)) AS totalPedidoN,
    CAST(COALESCE(NULLIF(REPLACE(impFac_Ped, ',', '.'), ''), '0.00') AS DECIMAL(12, 2)) AS total_factura,
    nom_prod AS nombre_producto,
    linea,
    bandera,
    CAST(idCliente AS UNSIGNED) AS distribucion_id,  -- Convertir a int si es necesario
    STR_TO_DATE(fecEntrega, '%Y-%m-%d') AS fechaEntrega,
    prePed,
    cambiar,
    retirar,
    estado_Ped AS estado_pedido,
    tareaEst_Ped AS estado_tarea,
    chofer_Ped AS chofer,
    CAST(orden_Ped AS UNSIGNED) AS orden,  -- Convertir a int si es necesario
    STR_TO_DATE(fecFac_Ped, '%Y-%m-%d') AS fechaFactura,
    nroFac_Ped AS nroFactura,
    estadoSTK_ped AS estado_stock,
    TRUE AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.lineapedidos
WHERE
    preunit IS NOT NULL AND preunit != ''
    AND fechaPed IS NOT NULL AND fecEntrega IS NOT NULL AND fecFac_Ped IS NOT NULL;
