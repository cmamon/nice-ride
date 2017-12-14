DELIMITER //
DROP TRIGGER IF EXISTS check_member_rate_in_range //
CREATE TRIGGER insert_member_rate_in_range
BEFORE INSERT ON MEMBER
FOR EACH ROW
BEGIN
    IF NEW.rate < 0.0 THEN
        SET NEW.rate = 0.0;
    ELSEIF NEW.rate > 5.0 THEN
        SET NEW.rate = 5.0;
    END IF;
END;//

DROP TRIGGER IF EXISTS check_member_rate_in_range //
CREATE TRIGGER update_member_rate_in_range
BEFORE UPDATE ON MEMBER
FOR EACH ROW
BEGIN
    IF NEW.rate < 0.0 THEN
        SET NEW.rate = 0.0;
    ELSEIF NEW.rate > 5.0 THEN
        SET NEW.rate = 5.0;
    END IF;
END;//
DELIMITER ;
DELIMITER ;
