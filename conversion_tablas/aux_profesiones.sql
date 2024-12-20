INSERT INTO fraschina_2024.auxprofesiones (id, nombreprofesion, representaciones, distribuciones, molinos, proveedores, agros, transportes, agendas, created_at, updated_at)
SELECT 
    Idprofesion AS id,
    Profesion AS nombreprofesion,
    clirep AS representaciones,
    clidis AS distribuciones,
    molinos AS molinos,
    proveedores AS proveedores,
    agro AS agros,
    transporte AS transportes,
    Agenda AS agendas,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxprofesion;

