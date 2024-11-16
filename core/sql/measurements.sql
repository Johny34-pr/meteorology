SELECT
    o.name as operator_name,
    i.name as instrument_name,
    value,
    unit,
    timestamp,
    station_name
FROM
    `measurements` m
    INNER JOIN `operators` o ON o.operator_id = m.operator_id
    INNER JOIN `instruments` i ON i.instrument_id = m.instrument_id
    LEFT JOIN `locations` l ON l.location_id = m.location_id
WHERE 
    ({operator_id} IS NULL OR o.operator_id = {operator_id})
ORDER BY
    timestamp DESC;