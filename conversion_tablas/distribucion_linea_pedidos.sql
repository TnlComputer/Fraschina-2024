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
    STR_TO_DATE(fechaPed, '%Y-%m-%d') AS fecha,  -- Convertir a formato de fecha
    producto_id,
    cantidad,
    CAST(COALESCE(NULLIF(REPLACE(preunit, ',', '.'), ''), '0') AS DECIMAL(12, 2)) AS precio_unitario,  -- Reemplazar coma y manejar '0' vacío
    CAST(COALESCE(NULLIF(REPLACE(totalPedido, ',', '.'), ''), '0.00') AS DECIMAL(12, 2)) AS totalPedido,  -- Reemplazar coma y manejar '0' vacío
    CAST(COALESCE(NULLIF(REPLACE(totalPedidoN, ',', '.'), ''), '0.00') AS DECIMAL(12, 2)) AS totalPedidoN,  -- Reemplazar coma y manejar '0' vacío
    CAST(COALESCE(NULLIF(REPLACE(impFac_Ped, ',', '.'), ''), '0.00') AS DECIMAL(12, 2)) AS total_factura,  -- Reemplazar coma y manejar '0' vacío
    nom_prod AS nombre_producto,
    linea,
    bandera,
    idCliente AS distribucion_id,
    STR_TO_DATE(fecEntrega, '%Y-%m-%d') AS fechaEntrega,  -- Convertir a formato de fecha
    prePed,
    cambiar,
    retirar,
    estado_Ped AS estado_pedido,
    tareaEst_Ped AS estado_tarea,
    chofer_Ped AS chofer,
    orden_Ped AS orden,
    STR_TO_DATE(fecFac_Ped, '%Y-%m-%d') AS fechaFactura,  -- Convertir a formato de fecha
    nroFac_Ped AS nroFactura,
    estadoSTK_ped AS estado_stock,  -- Corregir el mapeo del estado stock
    TRUE AS status,  -- Asignar 'true' a la columna status
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha y hora actual para updated_at
FROM fraschin_backup.lineaPedidos
WHERE 
    preunit IS NOT NULL AND preunit != ''  -- Asegurar que 'preunit' no sea nulo ni vacío
    AND fechaPed IS NOT NULL AND fecEntrega IS NOT NULL AND fecFac_Ped IS NOT NULL;
