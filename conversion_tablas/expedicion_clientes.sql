INSERT INTO fraschina_2024.expedicion_clientes (
    id, 
    nroClie_id, 
    linea1, 
    linea2, 
    linea3, 
    linea4, 
    linea5, 
    linea6, 
    obs, 
    comentarios, 
    created_at, 
    updated_at
)
SELECT 
    idExpClie AS id, 
    nroClieExp AS nroClie_id, 
    linea1Exp AS linea1, 
    linea2Exp AS linea2, 
    linea3Exp AS linea3, 
    linea4Exp AS linea4, 
    linea5Exp AS linea5, 
    linea6Exp AS linea6, 
    ObsExp AS obs, 
    ComentExp AS comentarios, 
    CURRENT_TIMESTAMP AS created_at, 
    CURRENT_TIMESTAMP AS updated_at
FROM 
    fraschin_backup.expedicionclie;
