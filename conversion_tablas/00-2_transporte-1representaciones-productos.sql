SET foreign_key_checks = 0;

INSERT INTO
    fraschina_2024.representacion_productos (
        id,
        representacion_id,
        producto_id,
        pl,
        P,
        l,
        w,
        glutenhumedo,
        glutenseco,
        cenizas,
        fn,
        humedad,
        estabilidad,
        absorcion,
        puntuaciones,
        particularidades,
        status,
        created_at,
        updated_at
    )
SELECT
    pc.IdProCli AS id,
    IF(
        pc.Idcliente = 0,
        NULL,
        pc.Idcliente
    ) AS representacion_id,
    pc.Idproducto AS producto_id,
    pc.PL AS pl,
    pc.P AS P,
    pc.L AS l,
    pc.W AS w,
    pc.GlutenHumedo AS glutenhumedo,
    pc.GlutenSeco AS glutenseco,
    pc.Cenizas AS cenizas,
    pc.FN AS fn,
    pc.Humedad AS humedad,
    pc.Estabilidad AS estabilidad,
    pc.Absorcion AS absorcion,
    pc.Puntuaciones AS puntuaciones,
    pc.PARTICULARIDADES AS particularidades,
    'A' AS status,
    CURRENT_TIMESTAMP AS created_at,
    CURRENT_TIMESTAMP AS updated_at
FROM fraschin_backup.productoporcliente pc
WHERE
    pc.IdProCli IS NOT NULL;

-- Asegura que solo se copien los registros válidos
SET foreign_key_checks = 1;