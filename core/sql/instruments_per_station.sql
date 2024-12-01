SELECT 
    l.station_name AS station,
    COUNT(i.instrument_id) AS instruments_count
FROM 
    LOCATIONS l
LEFT JOIN 
    INSTRUMENTS i
ON 
    l.location_id = i.location_id
WHERE 
    i.status = 'használatban'
GROUP BY 
    l.location_id
ORDER BY 
    instruments_count DESC;