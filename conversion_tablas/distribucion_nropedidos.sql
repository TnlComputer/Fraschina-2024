INSERT INTO
    fraschina_2024.distribucion_nropedidos (
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
    np.id_NroPed AS id,
    'D' AS tipo,
    np.cliente AS distribucion_id,
    -- Convertir fechaPed a NULL si es inválida
    IFNULL(np.fechaPed, NULL) AS fecha,
    -- Convertir fechaEnt a NULL si es inválida
    IFNULL(np.fechaEnt, NULL) AS fechaEntrega,
    np.obsPed AS observaciones,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.nropedidos np
WHERE
    np.cliente IN (
        SELECT id
        FROM fraschina_2024.distribucions
    )
    AND (
        -- Aseguramos que al menos una de las fechas sea válida
        np.fechaPed IS NOT NULL
        OR np.fechaEnt IS NOT NULL
    )
ON DUPLICATE KEY UPDATE
    tipo = VALUES(tipo),
    distribucion_id = VALUES(distribucion_id),
    fecha = VALUES(fecha),
    fechaEntrega = VALUES(fechaEntrega),
    observaciones = VALUES(observaciones),
    status = VALUES(status),
    created_at = VALUES(created_at),
    updated_at = VALUES(updated_at);


    