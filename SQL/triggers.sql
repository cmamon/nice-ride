DELIMITER //
DROP TRIGGER IF EXISTS insert_member_review_in_range //
CREATE TRIGGER insert_member_review_in_range
BEFORE INSERT ON MEMBER
FOR EACH ROW
BEGIN
    IF NEW.review < 0.0 THEN
        SET NEW.review = 0.0;
    ELSEIF NEW.review > 5.0 THEN
        SET NEW.review = 5.0;
    END IF;
END;//

DROP TRIGGER IF EXISTS update_member_review_in_range //
CREATE TRIGGER update_member_review_in_range
BEFORE UPDATE ON MEMBER
FOR EACH ROW
BEGIN
    IF NEW.review < 0.0 THEN
        SET NEW.review = 0.0;
    ELSEIF NEW.review > 5.0 THEN
        SET NEW.review = 5.0;
    END IF;
END;//

DROP TRIGGER IF EXISTS insert_member_age //
CREATE TRIGGER insert_member_age
BEFORE INSERT ON MEMBER
FOR EACH ROW
BEGIN
    CALL check_member_age(NEW.birthDate);
END;//

DROP TRIGGER IF EXISTS update_member_age //
CREATE TRIGGER update_member_age
BEFORE UPDATE ON MEMBER
FOR EACH ROW
BEGIN
    CALL check_member_age(NEW.birthDate);
END;//

DELIMITER ;
