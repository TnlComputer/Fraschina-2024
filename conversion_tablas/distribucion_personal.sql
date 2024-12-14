INSERT INTO fraschina_2024.distribucion_personal (
    id,
    nombre,
    apellido,
    distribucion_id,
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
    Idcliente AS distribucion_id,
    Idarea AS area_id,
    Idcargo AS cargo_id,
    NULL AS categoriacargo_id,
    TelDirecto AS teldirecto,
    LEFT(Interno, 4) AS interno, -- Truncar a 4 caracteres
    TelCelular AS telcelular,
    Idprofesion AS profesion_id,
    Telparticular AS telparticular,
    Mail AS email,
    INFOparticular AS observaciones,
    CASE 
        WHEN fuera = '1' THEN 1
        ELSE 0
    END AS fuera,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.personalclientesdist
WHERE 
    Ipersona IS NOT NULL;

