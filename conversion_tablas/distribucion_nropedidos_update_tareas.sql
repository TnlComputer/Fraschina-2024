UPDATE distribucion_nropedidos d
JOIN lineatareas l ON d.id = l.nroPed
SET
    d.tipo = CASE
        WHEN l.nroPed IS NOT NULL
        AND d.nroFactura IS NOT NULL THEN 'PT'
        ELSE 'T'
    END
WHERE
    l.nroPed IS NOT NULL;