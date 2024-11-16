SELECT 
    YEAR(timestamp) AS year,
    AVG(value) AS average_value,
    unit
FROM measurements
GROUP BY YEAR(timestamp), unit
ORDER BY YEAR(timestamp);