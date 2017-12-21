CREATE EVENT remove_past_trip_hourly
    ON SCHEDULE
      EVERY 1 HOUR
    COMMENT 'Remove trips before today'
    DO
      DELETE FROM TRIP WHERE date < CURDATE();
