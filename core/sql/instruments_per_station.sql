SELECT 
    l.station_name AS station,
    COUNT(i.instrument_id) AS instruments_count
FROM 
    locations l
LEFT JOIN 
    instruments i
ON 
    l.location_id = i.location_id
WHERE 
    i.status = 'használatban'
GROUP BY 
    l.location_id
ORDER BY 
    instruments_count DESC;