INSERT INTO fraschina_2024.molino_personal (
    id,
    nombre,
    apellido,
    molino_id,
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
    Idmolino AS molino_id,
    Idarea AS area_id,
    Idcargo AS cargo_id,
    cate_cargo AS categoriacargo_id,
    TelDirecto AS teldirecto,
    LEFT(Interno, 4) AS interno,  -- Limitar a 4 caracteres
    TelCelular AS telcelular,
    Idprofesion AS profesion_id,
    Telparticular AS telparticular,
    Mail AS email,
    INFOparticular AS observaciones,
    fuera,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.personalmolino
WHERE Ipersona IS NOT NULL;
