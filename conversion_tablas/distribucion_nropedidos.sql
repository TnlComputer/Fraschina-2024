INSERT INTO
    fraschina_2024.distribucion_nropedidos (
        id,
        distribucion_id,
        fecha,
        reservado,
        fechaEntrega,
        observaciones,
        status,
        created_at,
        updated_at
    )
SELECT
    id_NroPed AS id, -- Asignar el valor de id_NroPed a id
    cliente AS distribucion_id, -- Asignar cliente a distribucion_id
    STR_TO_DATE(fechaPed, '%Y-%m-%d') AS fecha, -- Convertir fechaPed a formato de fecha
    reservado, -- Mantener el valor de reservado
    CASE
        WHEN fechaEnt IS NOT NULL THEN STR_TO_DATE(fechaEnt, '%Y-%m-%d')
        ELSE NULL
    END AS fechaEntrega, -- Si 'fechaEnt' es NULL, asignar NULL, de lo contrario, convertir a fecha
    obsPed AS observaciones, -- Asignar el valor de obsPed a observaciones
    'A' AS status, -- Asignar un valor constante 'A' a status
    CURRENT_TIMESTAMP AS created_at, -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at -- Fecha y hora actual para updated_at
FROM fraschin_backup.nropedidos
WHERE
    cliente IN (
        SELECT id
        FROM fraschina_2024.distribucions
    );