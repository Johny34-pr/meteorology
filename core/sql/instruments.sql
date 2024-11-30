SELECT 
	i.instrument_id,
    i.name AS instrument_name,
    i.type,
    i.model_number,
    i.status,
    l.station_name
    FROM `instruments` i
INNER JOIN
	locations l ON i.location_id = l.location_id
WHERE
	i.location_id = (SELECT location_id FROM operators WHERE operator_id = {operator_id}) AND i.status = 1
ORDER BY 
	i.name ASC;