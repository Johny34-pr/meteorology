SELECT 
    YEAR(timestamp) AS year,
    MONTH(timestamp) AS month,
    AVG(value) AS average_value,
    unit
FROM measurements
WHERE YEAR(timestamp) = YEAR(NOW()) AND MONTH(timestamp) = MONTH(NOW())
GROUP BY YEAR(timestamp), MONTH(timestamp), unit
ORDER BY YEAR(timestamp), MONTH(timestamp);