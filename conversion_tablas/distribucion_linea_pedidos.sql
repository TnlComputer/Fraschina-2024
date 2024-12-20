INSERT INTO fraschina_2024.distribucion_linea_pedidos (
    id,
    pedido_nro,  -- Renombrado de 'pedido_id' a 'pedido_nro'
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
    id_linea AS id,  -- Asignando el ID de la tabla 'lineapedidos' a la nueva tabla
    CAST(nroPed AS UNSIGNED) AS pedido_nro,  -- Convertir 'nroPed' a 'pedido_nro' como tipo entero (sin signo)
    STR_TO_DATE(fechaPed, '%Y-%m-%d') AS fecha,  -- Convertir la fecha a formato adecuado
    CAST(producto_id AS UNSIGNED) AS producto_id,  -- Convertir el ID del producto a tipo entero
    CAST(COALESCE(NULLIF(cantidad, ''), '0') AS UNSIGNED) AS cantidad,  -- Convertir 'cantidad' a entero
    CAST(COALESCE(NULLIF(REPLACE(preunit, ',', '.'), ''), '0') AS DECIMAL(12, 2)) AS precio_unitario,  -- Convertir 'preunit' a decimal
    CAST(COALESCE(NULLIF(REPLACE(totalPedido, ',', '.'), ''), '0.00') AS DECIMAL(12, 2)) AS totalPedido,  -- Convertir 'totalPedido' a decimal
    CAST(COALESCE(NULLIF(REPLACE(totalPedidoN, ',', '.'), ''), '0.00') AS DECIMAL(12, 2)) AS totalPedidoN,  -- Convertir 'totalPedidoN' a decimal
    CAST(COALESCE(NULLIF(REPLACE(impFac_Ped, ',', '.'), ''), '0.00') AS DECIMAL(12, 2)) AS total_factura,  -- Convertir 'impFac_Ped' a decimal
    nom_prod AS nombre_producto,  -- Asignar 'nom_prod' como 'nombre_producto'
    linea,  -- Copiar 'linea'
    bandera,  -- Copiar 'bandera'
    CAST(idCliente AS UNSIGNED) AS distribucion_id,  -- Convertir 'idCliente' a entero sin signo
    STR_TO_DATE(fecEntrega, '%Y-%m-%d') AS fechaEntrega,  -- Convertir la fecha de entrega
    prePed,  -- Copiar 'prePed'
    cambiar,  -- Copiar 'cambiar'
    retirar,  -- Copiar 'retirar'
    estado_Ped AS estado_pedido,  -- Copiar 'estado_Ped' como 'estado_pedido'
    tareaEst_Ped AS estado_tarea,  -- Copiar 'tareaEst_Ped' como 'estado_tarea'
    chofer_Ped AS chofer,  -- Copiar 'chofer_Ped'
    CAST(orden_Ped AS UNSIGNED) AS orden,  -- Convertir 'orden_Ped' a entero sin signo
    STR_TO_DATE(fecFac_Ped, '%Y-%m-%d') AS fechaFactura,  -- Convertir la fecha de factura
    nroFac_Ped AS nroFactura,  -- Copiar 'nroFac_Ped' como 'nroFactura'
    estadoSTK_ped AS estado_stock,  -- Copiar 'estadoSTK_ped' como 'estado_stock'
    TRUE AS status,  -- Establecer el valor de 'status' a TRUE
    CURRENT_TIMESTAMP AS created_at,  -- Establecer la fecha actual para 'created_at'
    CURRENT_TIMESTAMP AS updated_at  -- Establecer la fecha actual para 'updated_at'
FROM fraschin_backup.lineapedidos
WHERE
    preunit IS NOT NULL AND preunit != ''
    AND fechaPed IS NOT NULL 
    AND fecEntrega IS NOT NULL 
    AND fecFac_Ped IS NOT NULL;
