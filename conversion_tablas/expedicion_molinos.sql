INSERT INTO fraschina_2024.expedicion_molinos (
    id, 
    nroMolino_id, 
    calificacion, 
    sigla, 
    nroUPed, 
    contMolino, 
    estadoNroPedido, 
    nroCliente_id, 
    created_at, 
    updated_at
)
SELECT 
    idExpMoli AS id, 
    nroMolinoExp AS nroMolino_id, 
    calificacionExp AS calificacion, 
    SiglaExp AS sigla, 
    nroUPedExp AS nroUPed, 
    contMoliExp AS contMolino, 
    estadoNroPed AS estadoNroPedido, 
    nroClieEst AS nroCliente_id, 
    CURRENT_TIMESTAMP AS created_at, 
    CURRENT_TIMESTAMP AS updated_at
FROM 
    fraschin_backup.expedicionmoli;
