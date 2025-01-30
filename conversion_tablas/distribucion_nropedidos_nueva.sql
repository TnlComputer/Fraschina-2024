INSERT INTO
    fraschina_2024.distribucion_nropedidon (
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
SELECT
    id, -- Respetamos el ID de distribucion_nropedidos
    'D' AS tipo,
    distribucion_id,
    fecha,
    fechaEntrega,
    observaciones,
    status,
    created_at,
    updated_at
FROM fraschin_backup.nropedidos;

UPDATE distribucion_nropedidos AS dn
JOIN fraschin_backup.distribucion_linea_pedidos AS dl ON dn.id = dl.pedido_id
SET
    dn.tipo = 'P',
    dn.fechaFactura = dl.fechaFactura,
    dn.nroFactura = dl.nroFactura,
    dn.totalFactura = dl.total_factura,
    dn.totalPedido = dl.totalPedidoN,
    dn.chofer = dl.chofer,
    dn.orden = dl.orden
WHERE
    dl.linea = '1';


UPDATE distribucion_nropedidon AS dn
JOIN distribucion_linea_tareas AS dt ON dn.id = dt.pedido_id
SET
    dn.tipo = 'T'
WHERE
    dt.linea = '1';