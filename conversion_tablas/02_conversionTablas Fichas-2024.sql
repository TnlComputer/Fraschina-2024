INSERT INTO fichas (
    m, pn, es, fe, ord, pl, ca, tb, k, p, i, d, n, fp, pp, o, origen_tabla, created_at, updated_at
)
SELECT
    COALESCE(NULLIF(A, ''), 0) AS m,  -- Si es NULL, se pone 0
    NULLIF(B, '') AS pn,
    C AS es,
    CASE 
        WHEN D REGEXP '^[0-9]{8}$' 
             AND SUBSTRING(D, 5, 2) BETWEEN '01' AND '12'
             AND SUBSTRING(D, 7, 2) BETWEEN '01' AND '31'
        THEN STR_TO_DATE(D, '%Y%m%d') 
        ELSE NULL 
    END AS fe,
    E AS ord,
    F AS pl,
    G AS ca,
    H AS tb,
    CAST(NULLIF(TRIM(I), '') AS UNSIGNED) AS k,
    CAST(NULLIF(TRIM(J), '') AS DECIMAL(10, 2)) AS p,
    CAST(NULLIF(TRIM(K), '') AS DECIMAL(10, 2)) AS i,
    L AS d,
    CAST( NULLIF(TRIM(M), '') AS UNSIGNED ) AS n,
    CASE 
        WHEN N REGEXP '^[0-9]{8}$' 
             AND SUBSTRING(N, 5, 2) BETWEEN '01' AND '12'
             AND SUBSTRING(N, 7, 2) BETWEEN '01' AND '31'
        THEN STR_TO_DATE(N, '%Y%m%d') 
        ELSE NULL 
    END AS fp,
    CAST( NULLIF(TRIM(O), '') AS UNSIGNED ) AS pp,
    P AS o,
    origen_tabla,
    NOW(),
    NOW()
FROM ficha
WHERE 
    (I REGEXP '^[0-9]+$' OR I = '');
