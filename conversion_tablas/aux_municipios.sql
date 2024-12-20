INSERT INTO fraschina_2024.auxmunicipios (id, ciudadmunicipio, representaciones, distribuciones, molinos, proveedores, agros, transportes, agendas, created_at, updated_at)
SELECT 
    Idmunicipio AS id,
    CiudadMunicipio AS ciudadmunicipio,
    clientes AS representaciones,  -- Mapeo de la columna 'clientes' a 'representaciones'
    clientesDist AS distribuciones, -- Mapeo de la columna 'clientesDist' a 'distribuciones'
    molinos AS molinos,
    proveedores AS proveedores,
    agro AS agros,
    transporte AS transportes,
    transporte AS agendas,  -- Mapeo de la columna 'transporte' a 'agendas'
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxmunicipio;
