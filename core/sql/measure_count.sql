SELECT 
    l.station_name AS Station,
    COUNT(m.measurement_id) AS Measurement_Count
FROM 
    locations l
LEFT JOIN 
    measurements m ON l.location_id = m.location_id
GROUP BY 
    l.station_name
ORDER BY 
    Measurement_Count DESC;