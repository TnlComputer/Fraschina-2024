UPDATE distribucion_nropedidos d
JOIN lineapedidos l ON d.id = l.nroPed
SET
    d.fechaFactura = l.fecFac_Ped,
    d.nroFactura = l.nroFac_Ped,
    d.totalFactura = l.impFac_Ped,
    d.totalPedido = l.totalPedidoN,
    d.chofer = l.chofer_Ped,
    d.orden = l.orden_Ped,
    d.observaciones = l.nom_prod,
    d.status = 'A',
    d.tipo = 'P'
WHERE
    l.linea = '1'
    AND l.totalPedido IS NOT NULL
    AND l.fecFac_Ped IS NOT NULL;
    -- AND l.fecFac_Ped <> '0000-00-00';