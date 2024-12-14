INSERT INTO fraschina_2024.agro_personal (
    id,
    nombre,
    apellido,
    agro_id,
    area_id,
    cargo_id,
    categoriacargo_id,
    teldirecto,
    interno,
    telcelular,
    profesion_id,
    telparticular,
    email,
    observaciones,
    fuera,
    status,
    created_at,
    updated_at
)
SELECT
    Ipersona AS id,
    Nombre AS nombre,
    Apellido AS apellido,
    Idagro AS agro_id,
    Idarea AS area_id,
    Idcargo AS cargo_id,
    cate_cargo AS categoriacargo_id,
    TelDirecto AS teldirecto,
    Interno AS interno,
    TelCelular AS telcelular,
    Idprofesion AS profesion_id,
    Telparticular AS telparticular,
    Mail AS email,
    INFOparticular AS observaciones,
    CASE WHEN fuera = '1' THEN 1 ELSE 0 END AS fuera,  -- Convertir 'fuera' de varchar a tinyint
    'A' AS status,  -- Asignar un valor constante para el campo 'status', por ejemplo, 'A' (activo)
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha y hora actual para updated_at
FROM fraschin_backup.personalagro
WHERE
    Ipersona IS NOT NULL;  -- Asegurarse de que 'Ipersona' no sea nulo
