INSERT INTO
    fraschina_2024.expedicion_general (
        fecha,
        mo,
        cl,
        modo,
        prod,
        p,
        l,
        pl,
        w,
        gh,
        gs,
        gi,
        hum,
        cz,
        est,
        abs,
        fn,
        punt,
        particularidades,
        status,
        created_at,
        updated_at
    )
SELECT
    FECHA,
    MO,
    CL,
    MODO,
    PROD,
    CAST(
        NULLIF(P, '') AS DECIMAL(10, 2)
    ), -- Convierte a DECIMAL si es necesario
    NULLIF(L, ''), -- Convierte valor vacío a NULL
    CAST(
        REPLACE (NULLIF(PL, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(W, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(GH, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(GS, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(GI, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(Hum, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(Cz, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(Est, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(Abs, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(FN, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    CAST(
        REPLACE (NULLIF(Punt, ''), ',', '.') AS DECIMAL(10, 2)
    ),
    PARTICULARIDADES,
    'A', -- Por defecto, el estado es 'A'
    NOW(),
    NOW()
FROM fraschina_2025.expedicion_general20250228;
-- FROM fraschin_backup.generalCR;