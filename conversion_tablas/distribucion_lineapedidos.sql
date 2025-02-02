INSERT INTO
    fraschina_2024.distribucion_linea_pedidos (
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
    CAST(lp.nroPed AS UNSIGNED), -- Convertir nroPed a número
    lp.idCliente, -- ID del cliente como distribucion_id
    lp.fechaPed,
    lp.fecEntrega,
    lp.linea,
    lp.producto_id,
    CAST(
        NULLIF(TRIM(lp.cantidad), '') AS UNSIGNED
    ), -- Evitar valores vacíos en cantidad
    CASE
        WHEN lp.preunit IS NOT NULL
        AND lp.preunit != '' THEN CAST(
            REPLACE (lp.preunit, ',', '.') AS DECIMAL(12, 2)
        ) -- Reemplazar coma por punto y convertir
        ELSE 0
    END, -- Convertir solo si tiene un valor válido, de lo contrario poner 0
    lp.totalPedidoN, -- Total de la línea del pedido
    lp.cambiar,
    lp.retirar,
    CAST(lp.estado_Ped AS CHAR(1)), -- Convertir estado a string
    1, -- Definir un estado por defecto (1 para activo)
    NOW(),
    NOW()
FROM fraschin_backup.lineapedidos AS lp
WHERE
    CAST(lp.nroPed AS UNSIGNED) IN (
        SELECT id
        FROM fraschina_2024.distribucion_nropedidos
    );