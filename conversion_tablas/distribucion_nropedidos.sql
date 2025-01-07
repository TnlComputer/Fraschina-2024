INSERT INTO fraschina_2024.distribucion_nropedidos (
    id,
    nropedido,
    distribucion_id,
    fecha,
    reservado,
    fechaEntreg,
    observaciones,
    status,
    created_at,
    updated_at
)
SELECT
    id_NroPed AS id,
    nroped AS nropedido,
    cliente AS distribucion_id,
    STR_TO_DATE(fechaPed, '%Y-%m-%d') AS fecha,  -- Convertir a formato de fecha
    reservado,
    STR_TO_DATE(fechaEnt, '%Y-%m-%d') AS fechaEntreg,  -- Convertir a formato de fecha
    obsPed AS observaciones,
    'active' AS status,  -- Asignar un valor constante para 'status', aquí es 'active'
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha y hora actual para updated_at
FROM fraschin_backup.nropedidos

