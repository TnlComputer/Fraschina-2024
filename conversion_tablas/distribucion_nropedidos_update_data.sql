UPDATE fraschina_2024.distribucion_nropedidos AS dn
LEFT JOIN fraschin_backup.lineapedidos AS lp ON dn.id = lp.nroPed
SET
    dn.tipo = CASE
        WHEN lp.nroPed IS NOT NULL THEN 'P'
        ELSE 'D'
    END,
    dn.fechaFactura = lp.fecFac_Ped,
    dn.nroFactura = lp.nroFac_Ped,
    dn.totalFactura = lp.impFac_Ped,
    dn.totalPedido = CASE
        WHEN lp.totalPedidoN IS NOT NULL
        AND lp.totalPedidoN REGEXP '^[0-9]+(\.[0-9]+)?$' THEN CAST(
            lp.totalPedidoN AS DECIMAL(10, 2)
        )
        ELSE NULL
    END,
    dn.chofer = lp.chofer_Ped,
    dn.orden = lp.orden_Ped
WHERE
    lp.linea = '1';