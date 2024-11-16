SELECT
    i.instrument_id,
    i.name AS instrument_name,
    i.type,
    i.model_number,
    i.status,
    l.station_name
FROM
    `operators` o
    INNER JOIN `locations` l ON l.location_id = o.location_id
    INNER JOIN `instruments` i ON i.location_id = l.location_id
WHERE
    i.location_id = (SELECT location_id FROM operators WHERE operator_id = {operator_id})
ORDER BY
    i.name ASC;