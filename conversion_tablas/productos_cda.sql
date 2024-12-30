-- INSERT INTO fraschina_2024.productos_c_d_a (
--     id,
--     productoCDA,
--     ivancda,
--     ivacda,
--     stockmincda,
--     stockmaxcda,
--     stockcda,
--     stockreservacda,
--     stockdisponiblecda,
--     stockfecentcda,
--     cantultent,
--     status,
--     created_at,
--     updated_at
-- )
-- SELECT 
--     idPcdA AS id,
--     ProductosCDA AS productoCDA,
--     ivaNCDA AS ivancda,
--     ivaCDA AS ivacda,
--     stockMinCDA AS stockmincda,
--     stockMaxCDA AS stockmaxcda,
--     stockCDA AS stockcda,
--     stockReserCDA AS stockreservacda,
--     stockDispoCDA AS stockdisponiblecda,
--     stkFecEntCDA AS stockfecentcda,
--     cantUltEnt AS cantultent,
--     'A' AS status, -- Valor predeterminado según tus reglas de negocio
--     NOW() AS created_at, -- Marca de tiempo actual
--     NOW() AS updated_at -- Marca de tiempo actual
-- FROM fraschin_backup.productoscda;



INSERT INTO fraschina_2024.productos_c_d_a (
    id,
    productoCDA,
    ivancda,
    ivacda,
    stockmincda,
    stockmaxcda,
    stockcda,
    stockreservacda,
    stockdisponiblecda,
    stockfecentcda,
    cantultent,
    status,
    created_at,
    updated_at
)
SELECT 
    idPcdA AS id,
    ProductosCDA AS productoCDA,
    ivaNCDA AS ivancda,
    ivaCDA AS ivacda,
    stockMinCDA AS stockmincda,
    stockMaxCDA AS stockmaxcda,
    stockCDA AS stockcda,
    stockReserCDA AS stockreservacda,
    stockDispoCDA AS stockdisponiblecda,
    stkFecEntCDA AS stockfecentcda,
    cantUltEnt AS cantultent,
    'A' AS status,
    NOW() AS created_at,
    NOW() AS updated_at
FROM fraschin_backup.productoscda;
