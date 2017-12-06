
ALTER session SET NLS_DATE_FORMAT='DD-MM-YYYY' ;

prompt -------------------------------------------;
prompt --- Suppression des anciens tuples --------;
prompt -------------------------------------------;

DELETE FROM CAR;
DELETE FROM MEMBER;
DELETE FROM ROUTE;
DELETE FROM TRIP;


INSERT INTO USER VALUES (1, "Christophe", "QUENETTE");

INSERT INTO MEMBER (1, 75, "Avenue",  "Augustin Fliche", "Montpellier", "+33750867489")

INSERT INTO CAR VALUES (1, 1, 'ANDRE', 'FRANCAISE');
